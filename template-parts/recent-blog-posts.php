<?php
// Argumentos da consulta para buscar os 3 posts mais recentes
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
);

$blog_query = new WP_Query($args);

// Exibe a seção de blog somente se houver posts publicados
if ($blog_query->have_posts()) :
?>
    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Blog</h2>
                <p>Posts recentes do nosso Blog</p>
            </div>

            <div class="row">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-box">
                        <div class="post-img">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid', 'alt' => esc_attr(get_the_title())]); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="meta">
                            <span class="post-date"><?php echo get_the_time('D, F j'); ?></span>
                            <span class="post-author"> / <?php the_author(); ?></span>
                        </div>
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="readmore stretched-link"><span>Ler mais</span><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

        </div>

    </section><?php endif; ?>