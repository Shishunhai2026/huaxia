<?php
/**
 * Template Name: 疾病科普
 *
 * ED科普专栏 — 100篇系列文章
 * 基于100篇权威医学文献，覆盖9大主题分类
 * 支持 /disease-science/{slug}/ 独立URL
 * SEO/GEO深度优化：每篇文章独立title/meta/OG/Schema
 */

// ============================================================
// 1. URL路由解析 — 从 /disease-science/{slug}/ 提取文章slug
// ============================================================
$article_slug = '';
$request_uri = $_SERVER['REQUEST_URI'];
// Match /disease-science/slug/ or /disease-science/slug
if (preg_match('#/disease-science/([a-zA-Z0-9_-]+)/?#', $request_uri, $m)) {
    $article_slug = sanitize_text_field($m[1]);
}

// ============================================================
// 2. 动态扫描文章目录
// ============================================================
function renova_scan_articles() {
    $dir = RENOVA_DIR . '/articles/';
    $files = glob($dir . '*.html');
    $articles = array();

    foreach ($files as $file) {
        $content = file_get_contents($file);
        $basename = basename($file, '.html');

        // Parse HTML comment header for metadata
        $meta = array(
            'title'   => '',
            'excerpt' => '',
            'tags'    => '',
        );
        if (preg_match('/^<!--\s*\n(.*?)\n-->/s', $content, $cmt)) {
            $header = $cmt[1];
            if (preg_match('/Title:\s*(.+)/', $header, $tm)) $meta['title'] = trim($tm[1]);
            if (preg_match('/Excerpt:\s*(.+)/', $header, $em)) $meta['excerpt'] = trim($em[1]);
            if (preg_match('/Tags:\s*(.+)/', $header, $gm)) $meta['tags'] = trim($gm[1]);
        }

        // Fallback: extract from <h2>
        if (empty($meta['title'])) {
            $body = preg_replace('/^<!--[\s\S]*?-->\s*/', '', $content);
            if (preg_match('/<h2[^>]*>(.*?)<\/h2>/', $body, $hm)) {
                $meta['title'] = trim(strip_tags($hm[1]));
            }
        }

        // Extract category from filename pattern: NN-{slug}.html
        $num = 0;
        $slug = '';
        if (preg_match('/^(\d+)-(.+)$/', $basename, $nm)) {
            $num = intval($nm[1]);
            $slug = $nm[2];
        }

        // Determine display category from number range
        $cat = renova_article_category($num);

        // Compute reading time
        $text = strip_tags($content);
        $chars = mb_strlen(preg_replace('/\s+/', '', $text));
        $minutes = max(1, round($chars / 400));

        $articles[] = array(
            'num'     => $num,
            'slug'    => $slug ?: $basename,
            'title'   => $meta['title'] ?: $basename,
            'excerpt' => $meta['excerpt'],
            'tags'    => $meta['tags'],
            'cat'     => $cat['label'],
            'cat_key' => $cat['key'],
            'chars'   => $chars,
            'minutes' => $minutes,
            'file'    => $file,
        );
    }

    // Sort by number
    usort($articles, function($a, $b) { return $a['num'] - $b['num']; });
    return $articles;
}

function renova_article_category($num) {
    if ($num >= 1  && $num <= 15) return array('key'=>'symptom',   'label'=>'🔍 症状自查与认知');
    if ($num >= 16 && $num <= 30) return array('key'=>'etiology',  'label'=>'🔬 病因探索');
    if ($num >= 31 && $num <= 45) return array('key'=>'local',     'label'=>'🏥 求医问药·本地搜索');
    if ($num >= 46 && $num <= 60) return array('key'=>'treatment', 'label'=>'💊 治疗方案探索');
    if ($num >= 61 && $num <= 70) return array('key'=>'cost',      'label'=>'💰 费用与医保');
    if ($num >= 71 && $num <= 80) return array('key'=>'drug',      'label'=>'💉 药物相关');
    if ($num >= 81 && $num <= 88) return array('key'=>'privacy',   'label'=>'🛡️ 就医顾虑与隐私');
    if ($num >= 89 && $num <= 96) return array('key'=>'recovery',  'label'=>'📈 效果预期与康复');
    if ($num >= 97 && $num <= 100)return array('key'=>'ai-tail',   'label'=>'🤖 AI搜索长尾句式');
    return array('key'=>'other', 'label'=>'📋 其他');
}

// ============================================================
// 3. 加载文章数据
// ============================================================
$all_articles = renova_scan_articles();

// Parse category filter from query string
$filter_cat = isset($_GET['cat']) ? sanitize_text_field($_GET['cat']) : '';
if ($filter_cat) {
    $all_articles = array_filter($all_articles, function($a) use ($filter_cat) {
        return $a['cat_key'] === $filter_cat;
    });
    $all_articles = array_values($all_articles);
}

// Find current article if viewing single
$current_article = null;
if ($article_slug) {
    foreach ($all_articles as $a) {
        if ($a['slug'] === $article_slug) {
            $current_article = $a;
            break;
        }
    }
    // If not found in filtered list, search unfiltered
    if (!$current_article) {
        $unfiltered = renova_scan_articles();
        foreach ($unfiltered as $a) {
            if ($a['slug'] === $article_slug) {
                $current_article = $a;
                break;
            }
        }
    }
}

// ============================================================
// 4. 读取文章内容（如果是单篇文章视图）
// ============================================================
$article_content = '';
if ($current_article) {
    $article_content = file_get_contents($current_article['file']);
    // Remove comment header
    $article_content = preg_replace('/^<!--[\s\S]*?-->\s*/', '', $article_content);
}

// ============================================================
// 5. 注入SEO元数据钩子（在get_header之前设置全局变量）
// ============================================================
if ($current_article) {
    $GLOBALS['renova_article'] = $current_article;
    $GLOBALS['renova_article_body'] = $article_content;
}

get_header();
renova_breadcrumb();

// ============================================================
// 6. 分类筛选导航数据
// ============================================================
$categories = array(
    array('key'=>'',        'label'=>'📋 全部 (100篇)', 'count'=>100),
    array('key'=>'symptom',   'label'=>'🔍 症状自查', 'count'=>15),
    array('key'=>'etiology',  'label'=>'🔬 病因探索', 'count'=>15),
    array('key'=>'local',     'label'=>'🏥 本地求医', 'count'=>15),
    array('key'=>'treatment', 'label'=>'💊 治疗方案', 'count'=>15),
    array('key'=>'cost',      'label'=>'💰 费用医保', 'count'=>10),
    array('key'=>'drug',      'label'=>'💉 药物对比', 'count'=>10),
    array('key'=>'privacy',   'label'=>'🛡️ 就医隐私', 'count'=>8),
    array('key'=>'recovery',  'label'=>'📈 效果康复', 'count'=>8),
    array('key'=>'ai-tail',   'label'=>'🤖 AI长尾', 'count'=>4),
);
?>

<?php if ($current_article): ?>
<!-- ================================================================== -->
<!-- 单篇文章视图 — 独立URL /disease-science/{slug}/                         -->
<!-- ================================================================== -->
<section class="page-header">
    <div class="container">
        <h1><?php echo esc_html($current_article['title']); ?></h1>
        <p class="page-desc">
            <span class="article-cat-badge" style="background:var(--bg-warm);color:var(--primary);padding:3px 12px;border-radius:20px;font-size:0.85rem;">
                <?php echo esc_html($current_article['cat']); ?>
            </span>
            👨‍⚕️ 审核：叶龙觉医生 ·
            ⏱ ~<?php echo $current_article['minutes']; ?>分钟 ·
            📝 ~<?php echo $current_article['chars']; ?>字 ·
            <a href="<?php echo home_url('/disease-science'); ?>" style="color:var(--primary);">← 返回科普专栏</a>
        </p>
    </div>
</section>

<section class="section section-white">
    <div class="container" style="max-width:780px;">
        <!-- Breadcrumb Schema -->
        <nav class="article-breadcrumb" style="font-size:0.85rem;color:var(--text-light);margin-bottom:24px;">
            <a href="<?php echo home_url(); ?>">首页</a> ›
            <a href="<?php echo home_url('/disease-science'); ?>">疾病科普</a> ›
            <span><?php echo esc_html($current_article['title']); ?></span>
        </nav>

        <article class="article-detail" itemscope itemtype="https://schema.org/MedicalWebPage">
            <meta itemprop="headline" content="<?php echo esc_attr($current_article['title']); ?>">
            <meta itemprop="description" content="<?php echo esc_attr($current_article['excerpt']); ?>">
            <meta itemprop="author" content="叶龙觉">
            <meta itemprop="publisher" content="星沙华夏医院">
            <link itemprop="mainEntityOfPage" href="<?php echo home_url('/disease-science/' . $current_article['slug'] . '/'); ?>">

            <div class="article-content" style="font-size:1.05rem;line-height:2.2;">
                <?php
                // Strip <h2> title (already in page-header), strip Gutenberg block comments
                $body = preg_replace('/<!-- wp:heading \{"level":2\} -->\s*<h2[^>]*>.*?<\/h2>\s*<!-- \/wp:heading -->/s', '', $article_content, 1);
                $body = preg_replace('/<!--\s*\/?\s*wp:[a-z-]+\s*[^{}]*\s*-->/', '', $body);
                $body = preg_replace('/<!--\s*\/?wp:list\s*-->/', '', $body);
                $body = preg_replace('/<figure class="wp-block-table">/', '', $body);
                $body = preg_replace('/<\/figure>/', '', $body);
                echo $body;
                ?>
            </div>

            <!-- Doctor Note -->
            <div class="doctor-note" style="background:var(--bg-warm);padding:24px;border-radius:var(--radius);margin:32px 0;border-left:4px solid var(--primary);">
                <h4 style="color:var(--primary);">👨‍⚕️ 叶医生提示</h4>
                <p style="color:var(--text-gray);margin:0;">本文仅供健康科普参考，不能替代专业医疗诊断。如有ED相关症状，建议到正规医疗机构就诊，由专业医生评估后制定个性化治疗方案。</p>
            </div>

            <!-- Tags -->
            <?php if ($current_article['tags']): ?>
            <div style="margin:20px 0;padding:16px;background:#f8f8f8;border-radius:var(--radius);">
                <strong>🏷️ 相关话题：</strong>
                <?php foreach (explode(',', $current_article['tags']) as $tag): ?>
                    <span style="display:inline-block;background:#eee;padding:2px 10px;border-radius:12px;font-size:0.82rem;margin:2px 4px;"><?php echo esc_html(trim($tag)); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Related articles -->
            <div class="related-articles" style="margin:40px 0;">
                <h3 style="margin-bottom:16px;">📚 相关文章推荐</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <?php
                // Find 4 related articles from same category
                $related_count = 0;
                foreach ($all_articles as $ra) {
                    if ($ra['slug'] === $current_article['slug']) continue;
                    if ($ra['cat_key'] === $current_article['cat_key'] && $related_count < 4) {
                        $related_count++;
                        echo '<a href="' . home_url('/disease-science/' . $ra['slug'] . '/') . '" style="display:block;padding:12px;background:var(--bg-warm);border-radius:8px;text-decoration:none;color:var(--text-dark);font-size:0.9rem;border-left:3px solid var(--primary);">';
                        echo esc_html($ra['title']);
                        echo '</a>';
                    }
                }
                ?>
                </div>
            </div>

            <!-- CTA -->
            <div style="text-align:center;padding:32px;background:linear-gradient(135deg,var(--bg-warm),#F5E6D3);border-radius:var(--radius);">
                <h4>读完文章还有疑问？</h4>
                <p style="color:var(--text-gray);">叶龙觉医生为您提供一对一私密咨询</p>
                <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary">预约免费咨询</a>
            </div>
        </article>

        <div style="text-align:center;margin-top:24px;">
            <a href="<?php echo home_url('/disease-science'); ?>" class="btn btn-outline">← 返回科普列表</a>
        </div>
    </div>
</section>

<?php else: ?>
<!-- ================================================================== -->
<!-- 文章列表视图 — /disease-science/                                       -->
<!-- ================================================================== -->
<section class="page-header">
    <div class="container">
        <h1>疾病科普</h1>
        <p class="page-desc">100篇系列文章 · 基于100篇权威文献汇编 · 叶龙觉医生审核 · 9大主题分类</p>
    </div>
</section>

<!-- 专栏介绍 -->
<section class="section section-white">
    <div class="container" style="max-width:960px;">

        <div style="background:linear-gradient(135deg,var(--bg-warm),#FFF8EE);padding:40px;border-radius:var(--radius);margin-bottom:40px;border:2px solid var(--border-warm);text-align:center;">
            <p style="font-size:1.3rem;color:var(--primary);font-family:var(--font-heading);margin-bottom:16px;">📚 全面了解勃起功能障碍（ED）</p>
            <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;">
                本专栏汇编了<strong>100篇ED（勃起功能障碍）科普系列文章</strong>，覆盖<strong>9大主题分类</strong>：
                症状自查与认知、病因探索、本地求医指南、治疗方案对比、费用与医保、药物知识、就医隐私顾虑、康复预期及AI搜索热门问答。
            </p>
            <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;">
                每篇文章约<strong>400-2000字</strong>，语言通俗易懂，旨在帮助读者<strong>科学认识ED、消除误解、正确就医</strong>。
                所有内容由<strong>叶龙觉医生</strong>审核，参考了100篇来自PubMed、EAU指南、中华男科学杂志等权威来源的医学文献。
            </p>
        </div>

        <!-- 文章分类导航 -->
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:40px;justify-content:center;">
            <?php foreach ($categories as $c):
                $active = ($filter_cat === $c['key']);
                $url = $c['key'] ? home_url('/disease-science/?cat=' . $c['key']) : home_url('/disease-science');
            ?>
                <a href="<?php echo esc_url($url); ?>"
                   style="background:<?php echo $active ? 'var(--primary)' : 'var(--bg-warm)'; ?>;
                          color:<?php echo $active ? '#fff' : 'var(--primary)'; ?>;
                          padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:600;text-decoration:none;">
                    <?php echo esc_html($c['label']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if ($filter_cat): ?>
        <div style="text-align:center;margin-bottom:24px;">
            <p style="color:var(--text-gray);">
                当前筛选：<strong><?php echo esc_html($categories[array_search($filter_cat, array_column($categories, 'key'))]['label'] ?? $filter_cat); ?></strong>
                · 共 <?php echo count($all_articles); ?> 篇
                · <a href="<?php echo home_url('/disease-science'); ?>">显示全部</a>
            </p>
        </div>
        <?php endif; ?>

        <!-- 文章列表 -->
        <div style="display:grid;gap:20px;">
            <?php
            $display_count = 0;
            foreach ($all_articles as $a):
                $display_count++;
                $num_str = str_pad($a['num'], 2, '0', STR_PAD_LEFT);
            ?>
                <div style="background:var(--bg-white);padding:24px 28px;border-radius:var(--radius);box-shadow:var(--shadow-card);border-left:4px solid var(--primary);display:grid;grid-template-columns:56px 1fr;gap:18px;align-items:center;transition:transform 0.2s,box-shadow 0.2s;cursor:pointer;"
                     onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='var(--shadow-md)';"
                     onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-card)';"
                     onclick="location.href='<?php echo home_url('/disease-science/' . $a['slug'] . '/'); ?>'">
                    <div style="width:52px;height:52px;background:var(--bg-warm);border-radius:14px;display:flex;align-items:center;justify-content:center;font-family:var(--font-heading);font-size:1.2rem;font-weight:700;color:var(--primary);">
                        <?php echo $a['num']; ?>
                    </div>
                    <div>
                        <div style="margin-bottom:6px;">
                            <span style="background:var(--bg-warm);color:var(--primary);padding:2px 10px;border-radius:20px;font-size:0.75rem;">
                                <?php echo esc_html($a['cat']); ?>
                            </span>
                        </div>
                        <h3 style="margin-bottom:6px;font-size:1.05rem;">
                            <a href="<?php echo home_url('/disease-science/' . $a['slug'] . '/'); ?>"
                               style="color:var(--text-dark);text-decoration:none;">
                                <?php echo esc_html($a['title']); ?>
                            </a>
                        </h3>
                        <?php if ($a['excerpt']): ?>
                        <p style="color:var(--text-gray);font-size:0.88rem;margin-bottom:4px;">
                            <?php echo esc_html(mb_substr($a['excerpt'], 0, 100)); ?>
                            <?php if (mb_strlen($a['excerpt']) > 100) echo '...'; ?>
                        </p>
                        <?php endif; ?>
                        <small style="color:var(--text-light);">
                            👨‍⚕️ 审核：叶龙觉医生 · ⏱ ~<?php echo $a['minutes']; ?>分钟 · 📝 ~<?php echo $a['chars']; ?>字
                        </small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($all_articles) === 0): ?>
        <div style="text-align:center;padding:60px;">
            <p style="font-size:1.2rem;color:var(--text-gray);">该分类下暂无文章</p>
            <a href="<?php echo home_url('/disease-science'); ?>" class="btn btn-outline">查看全部文章</a>
        </div>
        <?php endif; ?>

        <!-- Stats bar -->
        <div style="display:flex;flex-wrap:wrap;gap:20px;justify-content:center;margin-top:48px;padding:32px;background:var(--bg-warm);border-radius:var(--radius);">
            <div style="text-align:center;"><div style="font-size:2rem;font-weight:700;color:var(--primary);">100</div><div style="font-size:0.85rem;color:var(--text-gray);">系列文章</div></div>
            <div style="text-align:center;"><div style="font-size:2rem;font-weight:700;color:var(--primary);">9</div><div style="font-size:0.85rem;color:var(--text-gray);">主题分类</div></div>
            <div style="text-align:center;"><div style="font-size:2rem;font-weight:700;color:var(--primary);">100+</div><div style="font-size:0.85rem;color:var(--text-gray);">参考文献</div></div>
            <div style="text-align:center;"><div style="font-size:2rem;font-weight:700;color:var(--primary);">~5min</div><div style="font-size:0.85rem;color:var(--text-gray);">平均阅读</div></div>
        </div>

        <!-- 底部CTA -->
        <div style="text-align:center;background:linear-gradient(135deg,var(--bg-warm),#F5E6D3);padding:40px;border-radius:var(--radius);margin-top:40px;">
            <h3 style="margin-bottom:12px;">📚 读完文章还有疑问？</h3>
            <p style="color:var(--text-gray);margin-bottom:20px;">叶龙觉医生为您提供一对一私密咨询<br>免费初诊评估，明确ED类型后制定个性化方案</p>
            <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary btn-large">预约免费咨询</a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
