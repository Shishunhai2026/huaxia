<?php
/**
 * Template Name: 疾病科普
 *
 * ED科普专栏 — 13篇系列文章的完整列表页
 * 基于100篇权威医学文献汇编，翁青山博士审核
 * 支持 ?article=slug 直接查看单篇文章
 * 目标关键词：ED科普、阳痿知识、勃起功能障碍
 */
get_header();
renova_breadcrumb();

// 文章查看模式：?article=xxx
$article_slug = isset($_GET['article']) ? sanitize_text_field($_GET['article']) : '';
$article_file = '';
$article_content = '';

if ($article_slug) {
    // 文件名带数字前缀，如 01-chongjibo-ED-xiaoguo.html
    $pattern = RENOVA_DIR . '/articles/*-' . basename($article_slug) . '.html';
    $matches = glob($pattern);
    if (!empty($matches)) {
        $article_file = $matches[0];
        $article_content = file_get_contents($article_file);
        $article_content = preg_replace('/^<!--[\s\S]*?-->\s*/', '', $article_content);
        preg_match('/<h2[^>]*>(.*?)<\/h2>/', $article_content, $matches2);
        $article_title = $matches2[1] ?? '科普文章';
    }
}
?>

<?php if ($article_slug && $article_content): ?>
<!-- ===== 单篇文章视图 ===== -->
<section class="page-header">
    <div class="container">
        <h1><?php echo esc_html(strip_tags($article_title)); ?></h1>
        <p class="page-desc">ED科普专栏 · 翁青山博士审核 · <a href="<?php echo home_url('/disease-science'); ?>">← 返回科普列表</a></p>
    </div>
</section>
<section class="section section-white">
    <div class="container" style="max-width:780px;">
        <article class="article-detail">
            <div class="article-content" style="font-size:1.05rem;line-height:2.2;">
                <?php
                // Remove the first H2 (title, already shown in page-header)
                $body = preg_replace('/<!-- wp:heading -->\s*<h2[^>]*>.*?<\/h2>\s*<!-- \/wp:heading -->/s', '', $article_content, 1);
                // Convert WordPress Gutenberg blocks to plain HTML
                $body = preg_replace('/<!-- wp:heading \{"level":3\} -->\s*<h3>/', '<h3>', $body);
                $body = preg_replace('/<\/h3>\s*<!-- \/wp:heading -->/', '</h3>', $body);
                $body = preg_replace('/<!-- wp:paragraph -->\s*/', '', $body);
                $body = preg_replace('/\s*<!-- \/wp:paragraph -->/', '', $body);
                echo $body;
                ?>
            </div>
            <div class="doctor-note" style="background:var(--bg-warm);padding:24px;border-radius:var(--radius);margin:32px 0;border-left:4px solid var(--primary);">
                <h4 style="color:var(--primary);">👨‍⚕️ 翁医生提示</h4>
                <p style="color:var(--text-gray);margin:0;">本文仅供健康科普参考，不能替代专业医疗诊断。如有ED相关症状，建议到正规医疗机构就诊，由专业医生评估后制定个性化治疗方案。</p>
            </div>
            <div style="text-align:center;padding:32px;background:linear-gradient(135deg,var(--bg-warm),#F5E6D3);border-radius:var(--radius);">
                <h4>读完文章还有疑问？</h4>
                <p style="color:var(--text-gray);">翁青山博士为您提供一对一私密咨询</p>
                <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary">预约免费咨询</a>
            </div>
        </article>
        <div style="text-align:center;margin-top:24px;">
            <a href="<?php echo home_url('/disease-science'); ?>" class="btn btn-outline">← 返回科普列表</a>
        </div>
    </div>
</section>
<?php else: ?>
<!-- ===== 科普列表视图 ===== -->
<section class="page-header">
    <div class="container">
        <h1>疾病科普</h1>
        <p class="page-desc">13篇系列文章 · 基于100篇权威文献汇编 · 翁青山博士审核</p>
    </div>
</section>

<!-- 专栏介绍 -->
<section class="section section-white">
    <div class="container" style="max-width:900px;">

        <div style="background:linear-gradient(135deg,var(--bg-warm),#FFF8EE);padding:40px;border-radius:var(--radius);margin-bottom:48px;border:2px solid var(--border-warm);text-align:center;">
            <p style="font-size:1.2rem;color:var(--primary);font-family:var(--font-heading);margin-bottom:16px;">📚 全面了解勃起功能障碍（ED）</p>
            <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;">
                本专栏汇编了<strong>13篇ED（勃起功能障碍）科普系列文章</strong>，内容涵盖ED的流行病学、病因分类、诊断评估、
                治疗选择（药物/冲击波/中医/手术）、生活方式干预、就医指导等多个维度。
                每篇文章约<strong>400-1500字</strong>，语言通俗易懂，旨在帮助读者<strong>科学认识ED、消除误解、正确就医</strong>。
            </p>
            <p style="font-size:0.95rem;color:var(--text-light);margin-top:12px;">
                所有文章由<strong>翁青山博士</strong>审核，参考了100篇来自PubMed、中华男科学杂志、EAU指南等权威来源的医学文献。
            </p>
        </div>

        <!-- 文章分类导航 -->
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:40px;justify-content:center;">
            <span style="background:var(--primary);color:#fff;padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:600;">📋 全部 (13篇)</span>
            <span style="background:var(--bg-warm);color:var(--primary);padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:600;">🔬 疾病基础</span>
            <span style="background:var(--bg-warm);color:var(--primary);padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:600;">💊 治疗方案</span>
            <span style="background:var(--bg-warm);color:var(--primary);padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:600;">🏃 生活方式</span>
            <span style="background:var(--bg-warm);color:var(--primary);padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:600;">🌿 中医视角</span>
            <span style="background:var(--bg-warm);color:var(--primary);padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:600;">🏥 就医指南</span>
        </div>

        <!-- 文章列表 -->
        <div style="display:grid;gap:24px;">
            <?php
            // 13篇文章内联数据（零依赖，不依赖WordPress文章导入）
            $all_articles = array(
                array('num' => '01', 'cat' => '💊 治疗方案', 'title' => '冲击波治疗ED效果怎么样？——Renova临床数据全解析', 'desc' => 'Reisman(2015)58例、Bechara(2016)50例、Clavijo Meta分析——轻中度有效率90%+。', 'slug' => 'chongjibo-ED-xiaoguo'),
                array('num' => '02', 'cat' => '💊 治疗方案', 'title' => 'ED不吃药能治好吗？——从药物依赖到根源修复', 'desc' => '冲击波通过促进血管新生从根源改善勃起功能，与药物"治标"的本质区别。', 'slug' => 'ED-bu-chiyao'),
                array('num' => '03', 'cat' => '💊 治疗方案', 'title' => '吃了伟哥没效果了怎么办？——PDE5i无效ED患者的新选择', 'desc' => '冲击波治疗不依赖NO通路，对PDE5i无效者有效率60%+、持续12个月+。', 'slug' => 'PDE5i-wuxiao'),
                array('num' => '04', 'cat' => '🏃 生活方式', 'title' => '男性功能衰退怎么办？——40岁后男性性功能保养指南', 'desc' => '运动、饮食、体重管理、戒烟限酒、睡眠——科学保养延缓功能衰退。', 'slug' => 'nanxing-baoyang'),
                array('num' => '05', 'cat' => '🔬 疾病基础', 'title' => '血管性ED能治愈吗？——从病因到治疗的全面解读', 'desc' => '70%的ED属血管性。冲击波通过促进血管新生，从病理基础修复勃起功能。', 'slug' => 'xueguanxing-ED'),
                array('num' => '06', 'cat' => '💊 治疗方案', 'title' => '糖尿病导致ED怎么办？——糖尿病性ED治疗新途径', 'desc' => '糖尿病ED发病率达75%。冲击波可改善微循环，为糖尿病ED提供新希望。', 'slug' => 'tangniaobing-ED'),
                array('num' => '07', 'cat' => '🔬 疾病基础', 'title' => 'ED是心血管疾病的"报警信号"', 'desc' => '阴茎血管比冠状动脉细，ED通常比冠心病早2-5年出现——是心脏在求救。', 'slug' => 'ED-xinxueguan'),
                array('num' => '08', 'cat' => '💊 治疗方案', 'title' => 'ED最新治疗方法全解析：从药物到冲击波', 'desc' => 'PDE5i口服药、冲击波、注射、假体、中医——所有方案的适应症和优劣。', 'slug' => 'ED-zhiliao-zonglan'),
                array('num' => '09', 'cat' => '📋 诊断自评', 'title' => '硬度不够？科学自测你的ED严重程度', 'desc' => 'EHS硬度分级 + IIEF-EF自测量表 + 晨勃预警信号——早发现早干预。', 'slug' => 'ED-symptom-selfcheck'),
                array('num' => '10', 'cat' => '🔬 疾病基础', 'title' => 'ED不只是"肾虚"：年轻人阳痿的五大真凶', 'desc' => '压力焦虑、熬夜、久坐、色情成瘾、烟酒——不只是"肾虚"那么简单。', 'slug' => 'young-men-ED-causes'),
                array('num' => '11', 'cat' => '🏃 生活方式', 'title' => '变硬靠自己：运动与饮食改善勃起功能的科学方案', 'desc' => '有氧运动+凯格尔盆底肌训练+地中海饮食——最天然免费的"伟哥"。', 'slug' => 'lifestyle-improve-ED'),
                array('num' => '12', 'cat' => '🏥 就医指南', 'title' => '长沙看ED去哪家医院？一份实用的避坑指南', 'desc' => '查资质、看设备、识陷阱（包治/过度检查/模糊收费）、重隐私——五步选对。', 'slug' => 'how-to-choose-ED-clinic'),
                array('num' => '13', 'cat' => '🌿 中医视角', 'title' => '肾阴虚还是肾阳虚？中医治ED先辨对证，别乱吃补药', 'desc' => '肝郁、湿热、血瘀、阴虚、阳虚——五种证型辨证，盲目补肾越补越糟。', 'slug' => 'TCM-ED-syndrome-differentiation'),
            );
            foreach ($all_articles as $aidx => $a):
                $anchor_num = $aidx + 1; ?>
                <div style="background:var(--bg-white);padding:28px;border-radius:var(--radius);box-shadow:var(--shadow-card);border-left:4px solid var(--primary);display:grid;grid-template-columns:60px 1fr;gap:20px;align-items:center;">
                    <div style="width:56px;height:56px;background:var(--bg-warm);border-radius:14px;display:flex;align-items:center;justify-content:center;font-family:var(--font-heading);font-size:1.3rem;font-weight:700;color:var(--primary);"><?php echo $a['num']; ?></div>
                    <div>
                        <div style="margin-bottom:6px;">
                            <span style="background:var(--bg-warm);color:var(--primary);padding:2px 10px;border-radius:20px;font-size:0.75rem;"><?php echo $a['cat']; ?></span>
                        </div>
                        <h3 style="margin-bottom:6px;font-size:1.1rem;">
                            <a href="<?php echo home_url('/disease-science/?article=' . $a['slug']); ?>" style="color:var(--text-dark);text-decoration:none;"><?php echo esc_html($a['title']); ?></a>
                        </h3>
                        <p style="color:var(--text-gray);font-size:0.9rem;margin-bottom:4px;"><?php echo esc_html($a['desc']); ?></p>
                        <small style="color:var(--text-light);">👨‍⚕️ 审核：翁青山博士 · ⏱ 阅读约3-5分钟</small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 底部CTA -->
        <div style="text-align:center;background:linear-gradient(135deg,var(--bg-warm),#F5E6D3);padding:40px;border-radius:var(--radius);margin-top:48px;">
            <h3 style="margin-bottom:12px;">📚 读完文章还有疑问？</h3>
            <p style="color:var(--text-gray);margin-bottom:20px;">翁青山博士为您提供一对一私密咨询<br>免费初诊评估，明确ED类型后制定个性化方案</p>
            <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary btn-large">预约免费咨询</a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
