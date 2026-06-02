<?php
/**
 * 主索引页（博客列表页）
 *
 * 用于疾病科普文章列表
 */
get_header();
renova_breadcrumb();
?>

<main class="content-area">
    <div class="container">
        <header class="page-header">
            <h1>疾病科普</h1>
            <p class="page-desc">了解勃起功能障碍（ED）的科学知识，掌握男性健康保养方法</p>
        </header>

        <div class="content-with-sidebar">
            <div class="articles-list">
                <?php if (have_posts()): ?>
                    <div class="card-grid">
                        <?php while (have_posts()): the_post(); ?>
                            <article class="card" style="display:flex;flex-direction:column;">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="card-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('renova-card'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div style="padding:20px;flex-grow:1;">
                                    <h3 style="font-size:1.1rem;">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <p style="color:var(--text-gray);font-size:0.9rem;margin:8px 0;">
                                        <?php echo get_the_excerpt(); ?>
                                    </p>
                                    <div style="font-size:0.8rem;color:var(--text-light);margin-top:12px;">
                                        <?php echo get_the_date('Y-m-d'); ?> · 阅读<?php echo renova_reading_time(); ?>分钟
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <div class="pagination" style="margin-top:40px;text-align:center;">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '« 上一页',
                            'next_text' => '下一页 »',
                        ));
                        ?>
                    </div>
                <?php else: ?>
                    <p>暂无文章，敬请期待。</p>
                <?php endif; ?>
            </div>

            <aside class="sidebar">
                <div class="sidebar-widget">
                    <h4>文章分类</h4>
                    <ul class="sidebar-nav">
                        <?php wp_list_categories(array('title_li' => '', 'hide_empty' => true)); ?>
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h4>近期文章</h4>
                    <ul class="sidebar-nav">
                        <?php
                        $recent = wp_get_recent_posts(array('numberposts' => 6));
                        foreach ($recent as $post) {
                            echo '<li><a href="' . get_permalink($post['ID']) . '">' . $post['post_title'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="sidebar-widget" style="text-align:center;">
                    <h4>需要帮助？</h4>
                    <p style="font-size:0.9rem;color:var(--text-gray);">专业医生为您解答</p>
                    <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary" style="width:100%;">立即咨询</a>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
