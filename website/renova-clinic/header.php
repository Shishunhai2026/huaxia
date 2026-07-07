<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="baidu-site-verification" content="REPLACE_WITH_YOUR_BAIDU_VERIFICATION_CODE">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=yes">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <!-- 百度移动适配 -->
    <meta name="applicable-device" content="pc,mobile">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
    <div class="header-inner">
        <div class="site-branding">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <a href="<?php echo home_url(); ?>" class="site-logo" aria-label="返回首页">
                    <span>R</span>
                </a>
                <a href="<?php echo home_url(); ?>" class="site-title" style="color:var(--text-dark);">
                    星沙华夏医院
                    <small>Renova线性冲击波 · 专业ED治疗</small>
                </a>
            <?php endif; ?>
        </div>

        <button class="mobile-menu-toggle" aria-label="菜单" onclick="document.querySelector('.main-nav').classList.toggle('open')">
            ☰
        </button>

        <nav class="main-nav" itemscope itemtype="https://schema.org/SiteNavigationElement" aria-label="主导航">
            <a href="<?php echo home_url(); ?>" <?php if(is_front_page()) echo 'class="active"'; ?>>首页</a>
            <a href="<?php echo home_url('/about'); ?>" <?php if(is_page('about')) echo 'class="active"'; ?>>关于我们</a>
            <a href="<?php echo home_url('/treatment'); ?>" <?php if(is_page('treatment')) echo 'class="active"'; ?>>治疗项目</a>
            <a href="<?php echo home_url('/disease-science'); ?>" <?php if(is_page('disease-science')) echo 'class="active"'; ?>>疾病科普</a>
            <a href="<?php echo home_url('/clinical-evidence'); ?>" <?php if(is_page('clinical-evidence')) echo 'class="active"'; ?>>临床证据</a>
            <a href="<?php echo home_url('/patient-cases'); ?>" <?php if(is_page('patient-cases')) echo 'class="active"'; ?>>治疗案例</a>
            <a href="<?php echo home_url('/contact'); ?>" <?php if(is_page('contact')) echo 'class="active"'; ?>>联系我们</a>
        </nav>

        <div class="header-cta">
            <span class="header-phone">📞 <?php echo get_option('renova_phone', '15909415555'); ?></span>
            <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary btn-small">预约咨询</a>
        </div>
    </div>
</header>
