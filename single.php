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
    </section><section id="blog-single" class="blog-single">
        <div class="container" data-aos="fade-up">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

                    <article class="blog-details">

                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <h2 class="title"><?php the_title(); ?></h2>

                                <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-folder2"></i> <?php the_category(', '); ?></li>
                                    </ul>
                                </div>
                                <div class="content">
                                    <?php the_content(); ?>
                                </div>
                                <div class="meta-bottom">
                                    <i class="bi bi-tags"></i>
                                    <?php
                                        // Busca as tags do post
                                        $tags = get_the_terms( get_the_ID(), 'post_tag' );
                                        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
                                            $tag_links = array();
                                            foreach ( $tags as $tag ) {
                                                $tag_links[] = '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
                                            }
                                            echo implode( ', ', $tag_links );
                                        }
                                    ?>
                                </div></div>

                            <div class="col-lg-6">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-img">
                                        <?php the_post_thumbnail('full', ['class' => 'img-fluid rounded', 'alt' => esc_attr(get_the_title())]); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </article><?php endwhile; ?>
            <?php endif; ?>

        </div>
    </section>

    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-out">
            <div class="row g-5">
                <div class="col content">
                    <h3>Agende uma avaliação <em>gratuita</em></h3>
                    <a class="cta-btn align-self-start" href="<?php echo esc_url(home_url('/contato')); ?>"> Converse com um especialista agora <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>