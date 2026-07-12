<?php
/**
 * Renova Clinic Theme - Functions
 *
 * 星沙华夏医院 WordPress 主题函数
 */

// 防止直接访问
if (!defined('ABSPATH')) {
    exit;
}

// 加载Schema模块
require_once RENOVA_DIR . '/inc/schema.php';

// 加载GEO优化模块（AI搜索引擎适配）
require_once RENOVA_DIR . '/inc/geo.php';

// 加载百度主动推送模块
require_once RENOVA_DIR . '/inc/baidu-push.php';

// 加载Sitemap自动提交模块
require_once RENOVA_DIR . '/inc/sitemap-ping.php';

// 主题设置
define('RENOVA_VERSION', '1.0.0');
define('RENOVA_DIR', get_template_directory());
define('RENOVA_URI', get_template_directory_uri());

/**
 * 主题初始化
 */
function renova_theme_setup() {
    // 语言支持
    load_theme_textdomain('renova-clinic', RENOVA_DIR . '/languages');

    // 添加主题支持
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    // 注册菜单位置
    register_nav_menus(array(
        'primary' => __('主导航菜单', 'renova-clinic'),
        'footer'  => __('底部菜单', 'renova-clinic'),
    ));

    // 设置缩略图尺寸
    add_image_size('renova-hero', 800, 600, true);
    add_image_size('renova-card', 400, 300, true);
}
add_action('after_setup_theme', 'renova_theme_setup');

/**
 * URL重写规则 — 为科普专栏文章创建独立URL
 * /disease-science/{slug}/ → disease-science页面 + article查询参数
 */
function renova_query_vars($vars) {
    $vars[] = 'article';
    return $vars;
}
add_filter('query_vars', 'renova_query_vars');

function renova_rewrite_rules() {
    add_rewrite_rule(
        '^disease-science/([a-zA-Z0-9_-]+)/?$',
        'index.php?pagename=disease-science&article=$matches[1]',
        'top'
    );
}
add_action('init', 'renova_rewrite_rules');

/**
 * 加载CSS和JS
 */
function renova_enqueue_assets() {
    // 加载Google Fonts（中文字体）
    wp_enqueue_style(
        'renova-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@400;500;600;700&family=Noto+Serif+SC:wght@400;600;700&display=swap',
        array(),
        null
    );

    // 主题主样式
    wp_enqueue_style('renova-style', get_stylesheet_uri(), array(), RENOVA_VERSION);

    // 主题JS
    wp_enqueue_script('renova-script', RENOVA_URI . '/assets/js/main.js', array(), RENOVA_VERSION, true);

    // 首页特殊样式
    if (is_front_page()) {
        wp_enqueue_style('renova-home', RENOVA_URI . '/assets/css/home.css', array('renova-style'), RENOVA_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'renova_enqueue_assets');

/**
 * SEO优化 - DNS预解析（提升首屏速度）
 */
function renova_dns_prefetch() {
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//zz.bdstatic.com">' . "\n";
    echo '<link rel="preconnect" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="//fonts.gstatic.com" crossorigin>' . "\n";

    // hreflang: 中文中国
    $url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<link rel="alternate" hreflang="zh-CN" href="' . esc_url($url) . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($url) . '">' . "\n";
}
add_action('wp_head', 'renova_dns_prefetch', 1);

/**
 * 获取页面专属关键词
 * 基于《长沙市ED治疗关键词调研报告》200+关键词体系
 */
function renova_get_page_keywords() {
    // 基础通用关键词（所有页面共享）
    $base = array(
        // 疾病核心词（Table 0）
        '勃起功能障碍','男性勃起功能障碍','ED治疗','血管性ED','心理性ED','器质性ED',
        '阳痿','阳痿早泄','阳痿怎么治','阳痿能治好吗','阳痿吃什么药',
        'ED怎么改善','ED自愈方法','ED康复训练',
        // 症状词（Table 1）
        '硬度不够怎么办','硬不起来是什么原因','不够硬怎么调理','半硬不硬',
        '晨勃消失是什么原因','晨勃减少了正常吗','晨勃怎么恢复',
        // 治疗方式词（Table 2）
        '低能量冲击波治疗ED','体外冲击波治疗阳痿','ED物理治疗',
        // 机构词（Table 3）
        '长沙男科医院','长沙泌尿外科医院','长沙男性专科','长沙治疗阳痿',
        // 诊所品牌词
        '星沙华夏医院','叶龙觉医生','Renova冲击波',
    );

    // 页面专属关键词（基于报告Table 9-20意图分类）
    $page_kw = array();

    if (is_front_page() || is_home()) {
        // 首页：决策行动型 + 高搜索量核心词（Table 17-20）
        $page_kw = array(
            '长沙男科医院排名','长沙男科哪家好','长沙男科医院排名前十',
            '长沙治阳痿最好的医院','长沙男科专科医院','长沙看男科哪里好',
            '长沙性功能障碍治疗','长沙男科专家','长沙看男科最好的医生',
            '长沙县男科','长沙县男科医院','星沙男科医院','星沙治疗阳痿',
            '长沙男科网上挂号','长沙男科在线咨询','长沙男科医院电话',
            '长沙男科医院靠谱吗','长沙男科哪家不坑人',
            '冲击波治疗阳痿','PDE5i无效怎么办','糖尿病ED治疗',
            '中医治疗阳痿','不吃药治疗阳痿','阳痿怎么治疗最好',
            '男性功能保养','不吃药不手术治ED',
        );
    } elseif (is_page('treatment')) {
        // 治疗页：方案探索型（Table 13-16）
        $page_kw = array(
            '低能量冲击波','ED物理治疗','线性冲击波','线性冲击波治疗',
            '冲击波治疗ED效果','冲击波治疗ED费用','冲击波治疗阳痿效果',
            '冲击波和吃药哪个好','PDE5i无效替代方案','ED物理治疗多少钱',
            '不吃药不手术治ED','伟哥没效果了怎么办','阴茎假体还是冲击波好',
            '阳痿最好的治疗方法','轻度阳痿怎么调理','阳痿治疗需要多长时间',
            '中西医结合治疗阳痿','阳痿手术好还是吃药好',
            'Renova冲击波治疗','Renova治疗ED','Li-ESWT',
            '血管性ED治疗','糖尿病ED物理治疗',
        );
    } elseif (is_page('faq')) {
        // FAQ页：问题句式长尾词（Table 5）
        $page_kw = array(
            '阳痿能彻底治好吗','重度阳痿还能治好吗','糖尿病阳痿能治好吗',
            '长沙治疗阳痿哪家医院最好','长沙男科医院哪家口碑好',
            '阳痿会不会自己好','手淫会不会导致阳痿','伟哥会不会上瘾',
            '硬度不够怎么调理','硬度不够是什么原因造成的',
            '阳痿治疗需要多长时间','治疗阳痿需要住院吗','治疗阳痿能用医保吗',
            '伟哥可以长期吃吗','吃伟哥无效怎么办',
            '长沙治疗阳痿多少钱','阳痿检查费用多少钱',
            '冲击波治疗ED真的有效吗','冲击波治疗一个疗程不够怎么办',
            'ED会不会越来越严重','20岁阳痿能自愈吗',
        );
    } elseif (is_page('disease-science')) {
        // 单篇文章视图使用文章专属标签
        $article = $GLOBALS['renova_article'] ?? null;
        if ($article && !empty($article['tags'])) {
            $article_tags = array_map('trim', explode(',', $article['tags']));
            $page_kw = array_merge($article_tags, array(
                'ED科普','阳痿科普','勃起功能障碍科普',
                '星沙华夏医院','叶龙觉医生','长沙ED治疗',
            ));
        } else {
            $page_kw = array(
                'ED科普','阳痿科普','勃起功能障碍科普','ED文章','阳痿知识大全',
            'ED科普专栏','阳痿科普文章','硬度不够科普','晨勃消失科普',
            '冲击波治疗科普','PDE5i科普','中医治疗阳痿科普','糖尿病ED科普',
            '血管性ED科普','年轻人阳痿科普','男性功能保养科普',
            '阳痿的症状有哪些','如何判断是不是阳痿',
            '阳痿分几种类型','心理性ED和器质性ED区别','什么是ED',
            '阳痿是什么原因引起的','年轻人为什么会阳痿','糖尿病会导致阳痿吗',
            '高血压会导致ED吗','手淫会导致阳痿吗','压力大会导致阳痿吗',
            '硬度不够是什么原因','突然硬不起来了怎么回事',
            '硬一会就软了是什么问题','不能完全勃起是怎么回事',
            '晨勃消失了正常吗','晨勃减少了是什么原因',
            '如何预防阳痿','什么运动可以改善ED','吃什么食物对阳痿好',
            '如何保持勃起功能','什么年龄开始性功能下降',
            'ED与心血管疾病的关系','糖尿病与ED的关系',
        );
        }
    } elseif (is_page('about')) {
        // 关于页：信任验证型（Table 18, 20）
        $page_kw = array(
            '长沙男科专家','长沙看男科最好的医生','长沙中医男科专家',
            '叶龙觉','叶龙觉医生','长沙中医男科',
            '长沙男科医院靠谱吗','长沙男科哪家不坑人','长沙男科医院好不好',
            '长沙男科医院哪家正规','长沙专业男科医院',
            '湖南中医药大学男科教授','长沙老中医看男科',
            '星沙华夏医院怎么样','星沙华夏医院靠谱吗',
        );
    } elseif (is_page('contact')) {
        // 联系页：决策行动型（Table 19）
        $page_kw = array(
            '长沙男科网上挂号','长沙男科在线预约','长沙男科在线咨询',
            '长沙男科医院电话','长沙男科医院地址','长沙男科周末上班吗',
            '长沙男科夜诊','长沙男科夜诊服务',
            '湘雅男科怎么预约','长沙男科怎么预约',
            '长沙县星沙镇北斗路','星沙汽车站对面医院',
        );
    } elseif (is_page('patient-cases')) {
        $page_kw = array(
            'ED治疗案例','冲击波治疗效果分享','冲击波治疗真实效果',
            '长沙ED治疗成功案例','阳痿治疗案例','血管性ED治疗案例',
            '糖尿病ED治疗案例','PDE5i无效治疗案例',
        );
    } elseif (is_page('clinical-evidence')) {
        $page_kw = array(
            '冲击波治疗ED效果','Li-ESWT临床证据','Renova疗效数据',
            '冲击波治疗ED的临床研究','冲击波治疗ED研究',
            '低能量冲击波治疗ED证据','EAU指南冲击波治疗',
        );
    } elseif (is_single()) {
        $tags = wp_get_post_tags(get_the_ID(), array('fields' => 'names'));
        $page_kw = $tags ? $tags : array();
    }

    // 合并去重
    $all = array_unique(array_merge($base, $page_kw));
    return implode(',', $all);
}

/**
 * SEO优化 - 自动生成Meta Keywords（200+关键词覆盖）
 */
function renova_meta_keywords() {
    $keywords = renova_get_page_keywords();
    echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
}
add_action('wp_head', 'renova_meta_keywords', 1);

/**
 * SEO优化 - 自动生成Meta Description（页面专属优化）
 */
function renova_meta_description() {
    if (is_front_page() || is_home()) {
        echo '<meta name="description" content="星沙华夏医院位于长沙县星沙镇北斗路16号（星沙汽车站斜对面），引进以色列Renova体外线性冲击波治疗仪（国械注进20173095171），叶龙觉医生坐诊，专业治疗血管性勃起功能障碍（ED）。非侵入、无痛、不吃药不手术，轻中度ED有效率90%以上。一个疗程9600元（4次），长沙地区私密就诊环境。">' . "\n";
    } elseif (is_page('treatment')) {
        echo '<meta name="description" content="Renova线性冲击波治疗ED——以色列原装进口设备（国械注进20173095171），通过低能量冲击波促进阴茎海绵体血管新生，从根源治疗血管性ED。非侵入性，轻中度ED有效率90%+，PDE5i无效患者有效率60%+。了解治疗流程、费用、适应症。">' . "\n";
    } elseif (is_page('faq')) {
        echo '<meta name="description" content="冲击波治疗ED常见问题解答：阳痿能彻底治好吗？治疗需要多少钱？过程痛不痛？效果能维持多久？长沙治疗阳痿哪家医院最好？星沙华夏医院叶龙觉医生为您专业解答20+个ED治疗常见问题。">' . "\n";
    } elseif (is_page('disease-science')) {
        // 如果是单篇文章视图，使用文章专属描述
        $article = $GLOBALS['renova_article'] ?? null;
        if ($article && !empty($article['excerpt'])) {
            $desc = mb_substr($article['excerpt'], 0, 150);
            echo '<meta name="description" content="' . esc_attr($desc) . ' | 叶龙觉医生审核 | 星沙华夏医院 - 长沙ED治疗">' . "\n";
        } else {
            // 如果是分类筛选页面，添加noindex避免重复内容
            if (isset($_GET['cat']) && !empty($_GET['cat'])) {
                echo '<meta name="robots" content="noindex, follow">' . "\n";
            }
            echo '<meta name="description" content="全面了解勃起功能障碍（ED/阳痿）——100篇系列文章覆盖症状自查、病因探索、求医指南、治疗方案、费用医保、药物对比、就医隐私、康复预期9大主题。硬度不够是什么原因？晨勃消失怎么恢复？年轻人为什么会阳痿？基于100篇权威医学文献，叶龙觉医生审核。">' . "\n";
        }
    } elseif (is_page('about')) {
        echo '<meta name="description" content="星沙华夏医院位于长沙县星沙镇北斗路16号，10年+临床经验，叶龙觉医生亲自坐诊，引进以色列Renova线性冲击波治疗仪，专业开展血管性ED冲击波治疗和男性功能保养。一对一私密诊室，严格保护隐私。">' . "\n";
    } elseif (is_page('contact')) {
        echo '<meta name="description" content="预约星沙华夏医院——长沙专业ED治疗诊所。在线预约、电话预约、微信预约均可。地址：长沙县星沙镇北斗路16号（星沙汽车站斜对面）。周一至周六8:30-17:30，私密就诊环境，免费停车。">' . "\n";
    } elseif (is_page('patient-cases')) {
        echo '<meta name="description" content="Renova冲击波治疗ED真实案例：血管性ED、糖尿病ED、PDE5i无效ED等不同类型患者的治疗经历分享。匿名化处理，个人效果因人而异，仅供了解治疗方案参考。">' . "\n";
    } elseif (is_page('clinical-evidence')) {
        echo '<meta name="description" content="Renova冲击波治疗ED的科学研究证据：Reisman(2015)轻中度ED有效率90.57%、Bechara(2016)PDE5i无效有效率60%、Meta分析IIEF提升4.17分。EAU/APSSM/中华医学会指南推荐的一线治疗方案。">' . "\n";
    } elseif (is_page('symptom-check')) {
        echo '<meta name="description" content="ED症状自查：硬度不够、晨勃消失、硬一会就软了、不能完全勃起——这些症状意味着什么？通过IIEF-EF量表自我评估勃起功能，了解何时需要就医。长沙星沙华夏医院提供专业评估。">' . "\n";
    } elseif (is_page('pricing')) {
        echo '<meta name="description" content="长沙ED治疗费用透明公开：Renova冲击波治疗9600元/疗程（4次）、PDE5i药物价格、检查费用对比。了解为什么冲击波治疗从长远看比长期吃药更具性价比。治疗阳痿能用医保吗？">' . "\n";
    } elseif (is_page('mens-health')) {
        echo '<meta name="description" content="男性功能保养指南：如何预防阳痿？什么运动可以改善ED？40岁后如何保持勃起功能？饮食、运动、生活习惯全方位建议，帮助您维持男性健康。长沙星沙华夏医院专业指导。">' . "\n";
    } elseif (is_page('treatment-comparison')) {
        echo '<meta name="description" content="ED治疗方案全面对比：Renova冲击波 vs PDE5i口服药 vs 中医治疗 vs 海绵体注射 vs 假体植入手术。从治疗原理、有效率、费用、副作用、持久性5个维度对比，帮您选择最适合的ED治疗方案。">' . "\n";
    } elseif (is_single()) {
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            echo '<meta name="description" content="' . esc_attr(wp_trim_words($excerpt, 30)) . ' | 星沙华夏医院 - 长沙ED治疗">' . "\n";
        }
    } else {
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            echo '<meta name="description" content="' . esc_attr(wp_trim_words($excerpt, 30)) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'renova_meta_description', 1);

/**
 * SEO优化 - 自动添加Canonical URL
 */
function renova_canonical_url() {
    $article = $GLOBALS['renova_article'] ?? null;
    if ($article && is_page('disease-science')) {
        echo '<link rel="canonical" href="' . esc_url(home_url('/disease-science/' . $article['slug'] . '/')) . '">' . "\n";
    } elseif (is_single() || is_page()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">' . "\n";
    }
}
add_action('wp_head', 'renova_canonical_url', 2);

/**
 * SEO优化 - 自动添加OG标签
 */
function renova_og_tags() {
    echo '<meta property="og:locale" content="zh_CN">' . "\n";
    echo '<meta property="og:site_name" content="星沙华夏医院">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    // 科普文章详情页 — 文章专属OG标签
    $article = $GLOBALS['renova_article'] ?? null;
    if ($article && is_page('disease-science')) {
        echo '<meta property="og:title" content="' . esc_attr($article['title']) . ' - 星沙华夏医院">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(mb_substr($article['excerpt'], 0, 120)) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/disease-science/' . $article['slug'] . '/')) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="article:published_time" content="2026-07-12T00:00:00+08:00">' . "\n";
        echo '<meta property="article:modified_time" content="2026-07-13T00:00:00+08:00">' . "\n";
        echo '<meta property="article:author" content="叶龙觉">' . "\n";
        echo '<meta property="article:section" content="' . esc_attr($article['cat'] ?? 'ED科普') . '">' . "\n";
    } elseif (is_single() || is_page()) {
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . ' - 星沙华夏医院">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(wp_trim_words(get_the_excerpt(), 30)) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        if (has_post_thumbnail()) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($img[0]) . '">' . "\n";
            echo '<meta property="og:image:width" content="' . $img[1] . '">' . "\n";
            echo '<meta property="og:image:height" content="' . $img[2] . '">' . "\n";
        }
    } else {
        echo '<meta property="og:title" content="长沙ED治疗 | Renova冲击波治疗阳痿 | 星沙华夏医院">' . "\n";
        echo '<meta property="og:description" content="星沙华夏医院位于长沙县星沙镇北斗路16号，引进以色列Renova线性冲击波治疗仪（国械注进20173095171），叶龙觉医生坐诊。专业治疗血管性ED，非侵入、不手术、不吃药，有效率90%+。9600元/疗程。">' . "\n";
        echo '<meta property="og:url" content="' . home_url() . '">' . "\n";
        echo '<meta property="og:image" content="' . RENOVA_URI . '/assets/images/renova-device.jpg">' . "\n";
    }
    // Twitter card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action('wp_head', 'renova_og_tags', 3);

/**
 * Schema - 诊所信息（通过inc/schema.php中更完整的renova_get_clinic_schema输出）
 * 此处保留简化版本作为fallback
 */
function renova_schema_clinic() {
    // 优先使用 inc/schema.php 中的完整诊所Schema
    if (function_exists('renova_output_clinic_schema')) {
        renova_output_clinic_schema();
        return;
    }
    // Fallback — 简化版本
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalClinic',
        '@id' => home_url('/#clinic'),
        'name' => '星沙华夏医院',
        'url' => home_url(),
        'telephone' => '15909415555',
    );
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_clinic', 10);

/**
 * Schema - Article（文章页）
 */
function renova_schema_article() {
    if (!is_single()) return;
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalWebPage',
        'headline' => get_the_title(),
        'description' => get_the_excerpt(),
        'datePublished' => get_the_date('c'),
        'dateModified' => get_the_modified_date('c'),
        'author' => array('@type' => 'Person', 'name' => '叶龙觉'),
        'reviewedBy' => array('@type' => 'Person', 'name' => '叶龙觉'),
        'publisher' => array('@type' => 'MedicalClinic', 'name' => '星沙华夏医院'),
        'mainEntityOfPage' => array('@type' => 'WebPage', '@id' => get_permalink()),
    );
    if (has_post_thumbnail()) {
        $schema['image'] = get_the_post_thumbnail_url(null, 'large');
    }
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_article', 11);

/**
 * Schema - 科普文章详情页（Article + FAQPage + Breadcrumb）
 * 为 /disease-science/{slug}/ 生成独立的结构化数据
 */
function renova_schema_disease_article() {
    $article = $GLOBALS['renova_article'] ?? null;
    if (!$article || !is_page('disease-science')) return;

    $url = home_url('/disease-science/' . $article['slug'] . '/');

    // MedicalWebPage Schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalWebPage',
        'headline' => $article['title'],
        'description' => $article['excerpt'],
        'author' => array(
            '@type' => 'Person',
            'name' => '叶龙觉',
            'honorificPrefix' => '博士',
            'jobTitle' => '主治医师',
            'medicalSpecialty' => '男科',
        ),
        'reviewedBy' => array(
            '@type' => 'Person',
            'name' => '叶龙觉',
        ),
        'publisher' => array(
            '@type' => 'MedicalClinic',
            'name' => '星沙华夏医院',
            'url' => home_url(),
        ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => $url,
        ),
        'inLanguage' => 'zh-CN',
        'about' => array(
            '@type' => 'MedicalCondition',
            'name' => '勃起功能障碍',
            'alternateName' => array('ED', '阳痿'),
        ),
        'keywords' => $article['tags'],
    );

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_disease_article', 11);

/**
 * Schema - FaQ（FAQ页面 - 扩展到20+问答覆盖长尾词）
 */
function renova_schema_faq_page() {
    if (!is_page('faq') && !is_page('常见问题')) return;
    $faqs = array(
        // 效果类
        array('q'=>'冲击波治疗ED真的有效吗？','a'=>'有效，循证医学证据充分。Reisman等（2015）58例研究：轻中度血管性ED有效率90.57%，轻度ED有效率100%。Clavijo等（2017）Meta分析：IIEF评分平均提升4.17分（p<0.0001）。EAU/APSSM/中华医学会指南均推荐。'),
        array('q'=>'冲击波治疗的原理是什么？','a'=>'低能量冲击波通过机械应力效应刺激海绵体组织：①促进VEGF表达和血管新生（Angiogenesis）②激活内源性干细胞修复 ③改善血管内皮功能 ④促进nNOS阳性神经纤维再生。核心是"修复"ED的病理基础——受损的血管和神经，从根源上改善勃起功能。'),
        // 疼痛/安全类
        array('q'=>'治疗过程痛吗？要打麻药吗？','a'=>'基本无痛，无需麻醉。Renova能量密度仅0.09mJ/mm²属低能量冲击波。绝大多数患者仅有轻微针刺感或麻感，完全可以耐受。治疗结束后即可正常活动，不影响开车和工作。'),
        array('q'=>'冲击波治疗安全吗？有什么副作用？','a'=>'非常安全。所有已发表临床研究均未报告严重不良事件。少数可能出现治疗区域轻微发红（1-2小时消退）或微瘀点。Renova已获NMPA（中国）、CE（欧盟）等权威认证。'),
        // 费用/疗程类
        array('q'=>'需要治疗多少次？一个疗程多少钱？','a'=>'一个疗程共4次治疗，每周1次，每次约20分钟。费用：9600元/疗程（4次）。大多数患者一个疗程即可看到显著效果。少数重度患者可能需要第二个疗程巩固（间隔3-6个月后评估）。相比长期服用PDE5抑制剂（每片数十至上百元，需长期服药），冲击波治疗虽然单次投入较高，但长期看更具性价比——因为是针对病因的修复性治疗。'),
        array('q'=>'长沙治疗阳痿要多少钱？能用医保吗？','a'=>'星沙华夏医院Renova冲击波治疗ED费用为9600元/疗程（4次治疗）。冲击波治疗目前属于自费项目，暂不支持医保报销。长沙地区阳痿常规检查费用约200-500元。相比其他城市的冲击波治疗（通常12000-18000元），我们的费用在长沙地区属于合理水平。'),
        array('q'=>'冲击波治疗一个疗程不够怎么办？','a'=>'少数重度ED患者第一个疗程后可能需要第二疗程巩固。两个疗程之间建议间隔3-6个月，由医生评估后决定。通常第一个疗程就有改善，第二个疗程是巩固和进一步提升效果。'),
        // 药效类
        array('q'=>'PDE5i（伟哥/希爱力）没效果了，冲击波还有用吗？','a'=>'有用。Bechara等（2016）专门研究了50例PDE5抑制剂治疗无效的ED患者，冲击波治疗有效率达60%，疗效持续12个月。因为冲击波的机制是促进血管新生修复，不依赖已有NO通路，所以即使对药物已经产生耐受或效果变差的患者，冲击波仍然可能有效。'),
        array('q'=>'伟哥会不会上瘾？可以长期吃吗？','a'=>'PDE5抑制剂（伟哥/万艾可/金戈/希爱力等）不会产生生理上的成瘾依赖。但部分患者可能产生心理上的依赖——觉得不服药就不行。长期服用可能导致药效下降。冲击波治疗的优势在于通过促进血管修复从根本上改善勃起功能，不需要长期依赖药物。'),
        // 效果持续性
        array('q'=>'治疗后多久能看到效果？效果能维持多久？','a'=>'治疗2-3次后部分患者开始感受到晨勃恢复或硬度改善；疗程结束后1个月效果逐渐显现；疗程结束后3个月效果达到高峰（血管新生需要时间）。多项研究显示疗效可维持12-20个月以上，部分患者可根据需要每年做维护治疗。'),
        // 治愈类
        array('q'=>'阳痿能彻底治好吗？','a'=>'取决于ED的类型和严重程度。轻中度血管性ED通过Renova冲击波治疗，有效率90%以上，较大概率可以恢复正常勃起功能。重度ED、混合性ED可能需要综合治疗方案（冲击波+药物+生活方式调整）。关键是先到正规医疗机构明确诊断ED类型，再制定针对性治疗方案。'),
        array('q'=>'重度阳痿还能治好吗？','a'=>'重度ED（IIEF-EF≤7分）治疗难度更大，但仍有改善空间。部分重度ED患者通过Renova冲击波治疗后可以从重度改善到轻中度，配合小剂量PDE5i即可完成性生活。个别患者可能需要综合治疗（冲击波+药物+生活方式干预），由医生评估后制定个性化方案。'),
        array('q'=>'糖尿病阳痿能治好吗？','a'=>'糖尿病性ED治疗难度较大，因为高血糖同时对血管和神经造成损害。但冲击波治疗对糖尿病ED仍有帮助——通过促进血管新生改善海绵体血流。同时必须严格控制血糖，结合健康生活方式。部分患者治疗后结合小剂量PDE5i即可获得满意勃起。'),
        array('q'=>'20岁阳痿能自愈吗？','a'=>'年轻男性的ED多为心理性因素（焦虑、紧张、缺乏经验），部分可以随着心理状态改善而自愈。但如果症状持续超过3个月，或晨勃也消失，则提示可能存在器质性问题，建议到正规医疗机构检查。不要因为年轻就忽视ED的早期信号。'),
        // 病因类
        array('q'=>'手淫会不会导致阳痿？','a'=>'适度手淫一般不会导致阳痿。但过度频繁的手淫（如每天多次）可能导致：①暂时性的性疲劳②心理上的焦虑和负罪感③对正常性刺激的敏感度下降。如果已经出现勃起问题，减少手淫频率、增加运动、保证充足睡眠通常有帮助。如果症状持续，建议就医评估。'),
        array('q'=>'阳痿会不会自己好？','a'=>'如果ED是由暂时的因素（疲劳、压力、酒精、情绪波动）引起，在因素解除后可能自行恢复。但如果症状持续超过3个月，或出现晨勃消失，则提示可能存在器质性病变，一般不会自行好转，需要专业的医学评估和治疗。拖延不治可能加重病情。'),
        // 就医类
        array('q'=>'长沙治疗阳痿哪家医院最好？','a'=>'选择阳痿治疗机构应关注：①正规资质——持有医疗机构执业许可证②专业设备——是否有NMPA认证的冲击波治疗仪③医生经验——医生是否有丰富的男科诊疗经验④透明收费——费用是否公开透明。星沙华夏医院符合以上标准，叶龙觉医生亲自坐诊，引进以色列Renova原装设备。'),
        array('q'=>'看ED需要做什么检查？','a'=>'ED的常规检查包括：①详细问诊和IIEF-EF量表评估（了解ED类型和严重程度）②生殖系统体格检查③血常规、血糖、血脂、性激素（排除内科疾病）④必要时行阴茎彩色多普勒超声（评估血管功能）。检查费用约200-500元。不需要住院，当天完成。'),
        array('q'=>'来你们诊所看ED需要带什么？','a'=>'建议携带：①身份证②既往就诊记录和检查报告（如有）③正在服用的药物清单④如有糖尿病/高血压等慢性病相关的病历或检查结果。就诊前不需要特别准备（如禁食）。为保护隐私，请提前致电预约独立的就诊时间。'),
        // 保养类
        array('q'=>'如何预防阳痿？男性功能怎么保养？','a'=>'预防ED的建议：①保持规律运动（每周≥150分钟有氧运动+盆底肌训练）②控制体重，管理血压血糖血脂③戒烟限酒④保证充足睡眠，减轻压力⑤定期体检关注心血管健康。40岁后建议每年做一次男科检查，早期发现早期干预。'),
    );
    $entities = array();
    foreach ($faqs as $faq) {
        $entities[] = array(
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => array('@type' => 'Answer', 'text' => $faq['a']),
        );
    }
    $schema = array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities);
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_faq_page', 12);

/**
 * Schema - HowTo（治疗流程，治疗页）
 */
function renova_schema_howto() {
    if (!is_page('treatment')) return;
    $schema = renova_get_howto_schema();
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_howto', 13);

/**
 * Schema - ItemList（临床证据页）
 */
function renova_schema_clinical_studies() {
    if (!is_page('clinical-evidence')) return;
    $schema = renova_get_clinical_studies_schema();
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_clinical_studies', 13);

/**
 * Schema - 面包屑JSON-LD（所有非首页）
 */
function renova_schema_breadcrumb() {
    if (is_front_page()) return;
    $items = array();
    $items['首页'] = home_url();

    // 科普文章详情页 — 自定义面包屑
    $article = $GLOBALS['renova_article'] ?? null;
    if ($article && is_page('disease-science')) {
        $items['疾病科普'] = home_url('/disease-science');
        $items[$article['title']] = home_url('/disease-science/' . $article['slug'] . '/');
    } elseif (is_page()) {
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $ancestor) {
            $items[get_the_title($ancestor)] = get_permalink($ancestor);
        }
        $items[get_the_title()] = get_permalink();
    } elseif (is_single()) {
        $cat = get_the_category();
        if ($cat) {
            $items[$cat[0]->name] = get_category_link($cat[0]->term_id);
        }
        $items[get_the_title()] = get_permalink();
    }
    $schema = renova_get_breadcrumb_schema($items);
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_breadcrumb', 14);

/**
 * 面包屑导航
 */
function renova_breadcrumb() {
    echo '<div class="breadcrumb"><div class="container">';
    echo '<a href="' . home_url() . '">首页</a>';
    if (!is_front_page()) {
        echo '<span class="separator">›</span>';
        if (is_page()) {
            $ancestors = get_post_ancestors(get_the_ID());
            if ($ancestors) {
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor) {
                    echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
                    echo '<span class="separator">›</span>';
                }
            }
            echo '<span>' . get_the_title() . '</span>';
        } elseif (is_single()) {
            $category = get_the_category();
            if ($category) {
                echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a>';
                echo '<span class="separator">›</span>';
            }
            echo '<span>' . get_the_title() . '</span>';
        }
    }
    echo '</div></div>';
}

/**
 * 获取阅读时间
 */
function renova_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = mb_strlen(wp_strip_all_tags($content));
    $reading_time = ceil($word_count / 300);
    return max(1, $reading_time);
}

/**
 * 相关文章
 */
function renova_related_posts($count = 3) {
    $categories = get_the_category();
    if (!$categories) return;

    $cat_ids = wp_list_pluck($categories, 'term_id');
    $related = new WP_Query(array(
        'category__in' => $cat_ids,
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => $count,
        'ignore_sticky_posts' => 1,
    ));

    if ($related->have_posts()) {
        echo '<div class="related-posts"><h3>相关文章</h3><div class="card-grid">';
        while ($related->have_posts()) {
            $related->the_post();
            echo '<div class="card">';
            if (has_post_thumbnail()) {
                echo '<div class="card-image">' . get_the_post_thumbnail(null, 'renova-card') . '</div>';
            }
            echo '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '</div>';
        }
        echo '</div></div>';
    }
    wp_reset_postdata();
}

/**
 * 自定义wp_title（关键词丰富SEO标题）
 * 基于《长沙市ED治疗关键词调研报告》搜索漏斗优化
 */
function renova_wp_title($title, $sep) {
    if (is_front_page()) {
        $title = '长沙ED治疗 | Renova冲击波治疗阳痿 | 星沙华夏医院';
    } elseif (is_page('treatment')) {
        $title = 'Renova冲击波治疗ED | 长沙冲击波治疗阳痿 | 星沙华夏医院';
    } elseif (is_page('faq')) {
        $title = 'ED治疗常见问题 | 阳痿能治好吗 | 长沙治疗阳痿多少钱 | 星沙华夏医院';
    } elseif (is_page('disease-science')) {
        // 单篇文章视图使用文章专属标题
        $article = $GLOBALS['renova_article'] ?? null;
        if ($article && !empty($article['title'])) {
            $title = $article['title'] . ' | ED科普 | 星沙华夏医院 - 长沙ED治疗';
        } else {
            $title = 'ED科普专栏 | 阳痿知识大全 | 硬度不够的原因 | 晨勃消失怎么恢复 | 星沙华夏医院';
        }
    } elseif (is_page('about')) {
        $title = '关于我们 | 长沙男科专家叶龙觉医生 | 星沙华夏医院';
    } elseif (is_page('contact')) {
        $title = '联系我们 | 长沙男科预约挂号 | 在线咨询 | 星沙华夏医院';
    } elseif (is_page('patient-cases')) {
        $title = 'ED治疗案例 | 冲击波治疗真实效果 | 星沙华夏医院';
    } elseif (is_page('clinical-evidence')) {
        $title = '临床证据 | Renova冲击波治疗ED研究数据 | 星沙华夏医院';
    } elseif (is_page('symptom-check')) {
        $title = 'ED症状自查 | 硬度不够是什么原因 | 阳痿自测 | 星沙华夏医院';
    } elseif (is_page('pricing')) {
        $title = 'ED治疗费用 | 长沙治疗阳痿多少钱 | 冲击波治疗价格 | 星沙华夏医院';
    } elseif (is_page('mens-health')) {
        $title = '男性功能保养 | 如何预防阳痿 | 改善勃起功能 | 星沙华夏医院';
    } elseif (is_page('treatment-comparison')) {
        $title = 'ED治疗方案对比 | 冲击波vs吃药vs手术 | 哪种治疗最好 | 星沙华夏医院';
    } elseif (is_single() || is_page()) {
        $title = get_the_title() . ' | 星沙华夏医院 - 长沙ED治疗';
    }
    return $title;
}
add_filter('wp_title', 'renova_wp_title', 10, 2);

/**
 * 移除WordPress默认的emoji脚本（提升加载速度）
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * 禁用Gutenberg编辑器的全局样式（提升性能）
 */
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('global-styles');
}, 100);
