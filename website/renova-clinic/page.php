<?php
/**
 * 通用页面模板
 */
get_header();
?>

<?php if (!is_front_page()): ?>
    <?php renova_breadcrumb(); ?>
<?php endif; ?>

<main class="content-area">
    <div class="container">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <article <?php post_class('page-content'); ?>>
                <?php if (!is_front_page() && !is_page('contact')): ?>
                    <header class="page-header" style="text-align:left;padding:40px 0;">
                        <h1><?php the_title(); ?></h1>
                        <?php if (has_excerpt()): ?>
                            <p class="page-desc"><?php echo get_the_excerpt(); ?></p>
                        <?php endif; ?>
                    </header>
                <?php endif; ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
