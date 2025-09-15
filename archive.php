<?php
/**
 * Template para exibir páginas de arquivo (categorias, tags, autores).
 */

get_header(); ?>

<main id="main">

    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2><?php the_archive_title(); ?></h2>
                    <ol>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a></li>
                        <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a></li>
                        <li><?php the_archive_title(); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section id="blog" class="recent-blog-posts">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-lg-4">
                            <article class="post-box">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-img">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large', ['class' => 'img-fluid', 'alt' => esc_attr(get_the_title())]); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                <div class="meta">
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                    <span class="post-author"> / <?php the_author(); ?></span>
                                </div>
                                
                                <p><?php the_excerpt(); ?></p>

                                <a href="<?php the_permalink(); ?>" class="readmore stretched-link"><span>Ler mais</span><i class="bi bi-arrow-right"></i></a>

                            </article>
                        </div><?php endwhile; ?>

                <?php else : ?>
                    <div class="col-12">
                        <p>Não há posts para esta categoria ou tag.</p>
                    </div>
                <?php endif; ?>

            </div>

            <div class="blog-pagination">
                <?php the_posts_pagination(array(
                    'prev_text' => '<i class="bi bi-chevron-left"></i>',
                    'next_text' => '<i class="bi bi-chevron-right"></i>',
                )); ?>
            </div>

        </div>
    </section>

    <?php get_template_part( 'template-parts/cta-dois' ); ?>

</main>

<?php get_footer(); ?>