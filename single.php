<?php
/**
 * Template para a página de um único post do Blog.
 */

get_header(); ?>

<main id="main">

    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2><?php the_title(); ?></h2>
                    <ol>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">Início</a></li>
                        <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a></li>
                        <li><?php the_title(); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section id="blog-single" class="blog-single">
        <div class="container" data-aos="fade-up">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

                    <article class="blog-details">

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-img">
                                <?php the_post_thumbnail('full', ['class' => 'img-fluid', 'alt' => esc_attr(get_the_title())]); ?>
                            </div>
                        <?php endif; ?>

                        <h2 class="title"><?php the_title(); ?></h2>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-folder2"></i> <?php the_category(', '); ?></li>
                            </ul>
                        </div><div class="content">
                            <?php the_content(); ?>
                        </div><div class="meta-bottom">
                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <?php the_tags('<li>', '</li><li>', '</li>'); ?>
                            </ul>
                        </div></article><?php endwhile; ?>
            <?php endif; ?>

        </div>
    </section>

    <?php get_template_part( 'template-parts/cta-dois' ); ?>

</main>

<?php get_footer(); ?>