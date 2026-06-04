<?php
/**
 * Renova Clinic Theme - Functions
 *
 * 真颜堂中医诊所 WordPress 主题函数
 */

// 防止直接访问
if (!defined('ABSPATH')) {
    exit;
}

// 加载Schema模块
require_once RENOVA_DIR . '/inc/schema.php';

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
    echo '<link rel="preconnect" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="//fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'renova_dns_prefetch', 1);

/**
 * SEO优化 - 自动生成Meta Keywords
 */
function renova_meta_keywords() {
    $keywords = '长沙治疗阳痿,长沙ED治疗,长沙冲击波治疗ED,长沙男科医院,长沙男科诊所,Renova冲击波,低能量冲击波治疗ED,体外冲击波治疗阳痿,勃起功能障碍治疗,血管性ED,硬度不够怎么办,硬不起来是什么原因,阳痿能治好吗,晨勃消失怎么恢复,长沙治疗阳痿多少钱,雨花区男科,男性功能保养,真颜堂中医诊所,翁青山博士,冲击波治疗阳痿,PDE5i无效怎么办,糖尿病ED治疗,中医治疗阳痿,不吃药治疗阳痿,阳痿怎么治疗最好';
    if (is_page('treatment')) {
        $keywords .= ',低能量冲击波,ED物理治疗,线性冲击波,冲击波治疗ED效果,伟哥没效果了怎么办,阴茎假体还是冲击波好,不吃药不手术治ED';
    } elseif (is_page('faq')) {
        $keywords .= ',阳痿能彻底治好吗,长沙治疗阳痿哪家医院最好,阳痿会不会自己好,硬度不够怎么调理';
    } elseif (is_page('disease-science')) {
        $keywords .= ',ED科普,阳痿的症状有哪些,如何判断是不是阳痿,年轻人为什么会阳痿,糖尿病会导致阳痿吗';
    } elseif (is_page('about')) {
        $keywords .= ',长沙男科专家,长沙看男科最好的医生,长沙中医男科专家';
    } elseif (is_single()) {
        $tags = wp_get_post_tags(get_the_ID(), array('fields' => 'names'));
        if ($tags) $keywords .= ',' . implode(',', $tags);
    }
    echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
}
add_action('wp_head', 'renova_meta_keywords', 1);

/**
 * SEO优化 - 自动生成Meta Description
 */
function renova_meta_description() {
    if (is_single() || is_page()) {
        $post_id = get_queried_object_id();
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            echo '<meta name="description" content="' . esc_attr(wp_trim_words($excerpt, 30)) . '">' . "\n";
        }
    } elseif (is_home() || is_front_page()) {
        echo '<meta name="description" content="长沙岳麓区真颜堂中医诊所，引进以色列Renova体外线性冲击波治疗仪，专业治疗血管性勃起功能障碍（ED）。非侵入、无痛、安全有效，轻中度ED有效率90%以上。">' . "\n";
    }
}
add_action('wp_head', 'renova_meta_description', 1);

/**
 * SEO优化 - 自动添加Canonical URL
 */
function renova_canonical_url() {
    if (is_single() || is_page()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">' . "\n";
    }
}
add_action('wp_head', 'renova_canonical_url', 2);

/**
 * SEO优化 - 自动添加OG标签
 */
function renova_og_tags() {
    echo '<meta property="og:locale" content="zh_CN">' . "\n";
    echo '<meta property="og:site_name" content="真颜堂中医诊所">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    if (is_single() || is_page()) {
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . ' - 真颜堂中医诊所">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(wp_trim_words(get_the_excerpt(), 30)) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        if (has_post_thumbnail()) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($img[0]) . '">' . "\n";
            echo '<meta property="og:image:width" content="' . $img[1] . '">' . "\n";
            echo '<meta property="og:image:height" content="' . $img[2] . '">' . "\n";
        }
    } else {
        echo '<meta property="og:title" content="长沙ED治疗 | 真颜堂中医诊所">' . "\n";
        echo '<meta property="og:description" content="以色列Renova线性冲击波治疗血管性ED，非侵入、有效率90%+。翁青山博士坐诊。">' . "\n";
        echo '<meta property="og:url" content="' . home_url() . '">' . "\n";
        echo '<meta property="og:image" content="' . RENOVA_URI . '/assets/images/renova-device.jpg">' . "\n";
    }
    // Twitter card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action('wp_head', 'renova_og_tags', 3);

/**
 * Schema结构化数据 - 诊所信息
 */
function renova_schema_clinic() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalClinic',
        '@id' => home_url('/#clinic'),
        'name' => '真颜堂中医诊所',
        'description' => '专业治疗血管性勃起功能障碍（ED），引进以色列Renova线性冲击波治疗仪。翁青山博士坐诊，长沙市雨花区沙湾路品缦芸酒店5楼。',
        'url' => home_url(),
        'telephone' => '18973134733',
        'address' => array(
            '@type' => 'PostalAddress',
            'addressLocality' => '长沙市',
            'addressRegion' => '湖南省',
            'streetAddress' => '雨花区沙湾路品缦芸酒店5楼',
            'addressCountry' => 'CN',
        ),
        'openingHoursSpecification' => array(
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'),
            'opens' => '08:30',
            'closes' => '17:30',
        ),
        'medicalSpecialty' => '男科',
        'availableService' => array(
            array(
                '@type' => 'MedicalProcedure',
                'name' => 'Renova线性冲击波治疗ED',
                'description' => '使用以色列Renova体外线性冲击波治疗仪（国械注进20173095171），通过低能量冲击波促进阴茎海绵体血管新生，治疗血管性勃起功能障碍。非侵入性，轻中度ED有效率90%以上。',
                'procedureType' => 'NoninvasiveProcedure',
            ),
        ),
        'founder' => array(
            '@type' => 'Person',
            'name' => '翁青山',
            'honorificPrefix' => '博士',
            'medicalSpecialty' => '男科',
        ),
        'priceRange' => '9600元/疗程',
    );
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
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
        'author' => array('@type' => 'Person', 'name' => '翁青山'),
        'reviewedBy' => array('@type' => 'Person', 'name' => '翁青山'),
        'publisher' => array('@type' => 'MedicalClinic', 'name' => '真颜堂中医诊所'),
        'mainEntityOfPage' => array('@type' => 'WebPage', '@id' => get_permalink()),
    );
    if (has_post_thumbnail()) {
        $schema['image'] = get_the_post_thumbnail_url(null, 'large');
    }
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'renova_schema_article', 11);

/**
 * Schema - FAQ（FAQ页面）
 */
function renova_schema_faq_page() {
    if (!is_page('faq') && !is_page('常见问题')) return;
    $faqs = array(
        array('q'=>'冲击波治疗ED真的有效吗？','a'=>'有效，循证医学证据充分。Reisman等（2015）58例研究：轻中度血管性ED有效率90.57%。EAU/APSSM/中华医学会指南均推荐。'),
        array('q'=>'冲击波治疗的原理是什么？','a'=>'低能量冲击波通过机械应力刺激海绵体：促进VEGF表达和血管新生、激活内源性干细胞修复、改善血管内皮功能、促进神经修复。'),
        array('q'=>'治疗过程痛吗？','a'=>'基本无痛，无需麻醉。能量密度仅0.09mJ/mm²属低能量。绝大多数患者可耐受，治疗后可正常活动。'),
        array('q'=>'需要治疗多少次？多少钱？','a'=>'一个疗程4次，每周1次，每次约20分钟。费用9600元/疗程。多数患者一疗程见效。'),
        array('q'=>'PDE5i无效了还有用吗？','a'=>'有用。Bechara等（2016）研究：50例PDE5i无效患者有效率60%，持续12个月。冲击波促进血管修复，不依赖已有NO通路。'),
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
 * 自定义wp_title
 */
function renova_wp_title($title, $sep) {
    if (is_front_page()) {
        $title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
    } elseif (is_single() || is_page()) {
        $title = get_the_title() . ' - ' . get_bloginfo('name');
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
