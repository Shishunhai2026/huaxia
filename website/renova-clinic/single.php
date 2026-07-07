<?php
/**
 * 文章详情页（博客/科普文章）
 *
 * 用于"疾病科普"栏目的文章
 * 包含：Schema Article标记、阅读时间、面包屑、相关文章
 */
get_header();
renova_breadcrumb();
?>

<main class="content-area">
    <div class="container">
        <div class="content-with-sidebar">
            <article <?php post_class('article-detail'); ?> itemscope itemtype="https://schema.org/MedicalWebPage">
                <header class="article-header">
                    <h1 itemprop="headline"><?php the_title(); ?></h1>
                    <div class="article-meta">
                        <span>📅 <?php echo get_the_date('Y年m月d日'); ?></span>
                        <span>⏱ 阅读约<?php echo renova_reading_time(); ?>分钟</span>
                        <?php
                        $categories = get_the_category();
                        if ($categories): ?>
                            <span>📂 <?php the_category('、'); ?></span>
                        <?php endif; ?>
                        <span>👨‍⚕️ 审核：叶龙觉博士</span>
                    </div>
                </header>

                <?php if (has_post_thumbnail()): ?>
                    <div class="article-featured-image">
                        <?php the_post_thumbnail('large', array('itemprop' => 'image')); ?>
                    </div>
                <?php endif; ?>

                <div class="article-content" itemprop="text">
                    <?php the_content(); ?>
                </div>

                <!-- 文章底部医生提示 -->
                <div class="doctor-note" style="background:var(--bg-warm);padding:24px;border-radius:var(--radius);margin:32px 0;border-left:4px solid var(--primary);">
                    <h4 style="color:var(--primary);">👨‍⚕️ 叶医生提示</h4>
                    <p style="color:var(--text-gray);margin:0;">本文仅供健康科普参考，不能替代专业医疗诊断。如有ED相关症状，建议到正规医疗机构就诊，由专业医生评估后制定个性化治疗方案。</p>
                </div>

                <!-- 文章底部CTA -->
                <div style="text-align:center;padding:32px;background:linear-gradient(135deg,var(--bg-warm),#F5E6D3);border-radius:var(--radius);margin-bottom:32px;">
                    <h4>您是否正在面临类似困扰？</h4>
                    <p style="color:var(--text-gray);">星沙华夏医院提供专业ED评估与Renova冲击波治疗<br>私密就诊环境，严格保护隐私</p>
                    <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary">立即预约咨询</a>
                </div>

                <?php renova_related_posts(3); ?>
            </article>

            <aside class="sidebar">
<div class="sidebar-widget" style="text-align:center;">
                    <h4>预约咨询</h4>
                    <p style="font-size:0.9rem;color:var(--text-gray);">专业评估，私密就诊</p>
                    <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary" style="width:100%;">预约免费咨询</a>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
