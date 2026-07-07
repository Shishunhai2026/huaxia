<?php
/**
 * 404 页面 - 星沙华夏医院
 */
get_header();
?>
<main class="error-404" style="min-height:60vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:60px 0;">
    <div class="container">
        <h1 style="font-family:var(--font-heading);font-size:6rem;color:var(--primary);line-height:1;">404</h1>
        <h2 style="font-size:1.5rem;margin:16px 0 8px;color:var(--text-dark);">页面未找到</h2>
        <p style="color:var(--text-gray);margin-bottom:24px;line-height:1.7;">
            您访问的页面可能已被删除、更名或暂时不可用。<br>
            请尝试以下链接，或致电咨询。
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:8px;justify-content:center;margin-bottom:24px;">
            <a href="<?php echo home_url(); ?>" style="padding:10px 20px;background:var(--primary);color:#fff;text-decoration:none;border-radius:8px;">首页</a>
            <a href="<?php echo home_url('/treatment'); ?>" style="padding:10px 20px;background:var(--primary);color:#fff;text-decoration:none;border-radius:8px;">冲击波治疗</a>
            <a href="<?php echo home_url('/disease-science'); ?>" style="padding:10px 20px;background:var(--primary);color:#fff;text-decoration:none;border-radius:8px;">疾病科普</a>
            <a href="<?php echo home_url('/faq'); ?>" style="padding:10px 20px;background:var(--primary);color:#fff;text-decoration:none;border-radius:8px;">常见问题</a>
            <a href="<?php echo home_url('/contact'); ?>" style="padding:10px 20px;background:var(--primary);color:#fff;text-decoration:none;border-radius:8px;">联系我们</a>
        </div>
        <p style="font-size:1.1rem;color:var(--accent);">📞 咨询电话：<a href="tel:15909415555" style="color:var(--accent);text-decoration:none;font-weight:bold;">15909415555</a></p>
    </div>
</main>
<?php get_footer(); ?>
