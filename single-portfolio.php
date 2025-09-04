<?php
/**
 * Template para a página de detalhes de um item do Portfólio.
 */

get_header(); ?>

<main id="main">

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <section class="breadcrumbs">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <?php 
                                // Busca os campos personalizados
                                $cliente = get_post_meta( get_the_ID(), '_bandeiragroup_cliente', true );
                                $marca_id = get_post_meta( get_the_ID(), '_bandeiragroup_marca_id', true );
                                $marca_url = wp_get_attachment_url( $marca_id );
                                // Busca as Áreas de Atuação
                                $terms = get_the_terms( get_the_ID(), 'area-atuacao' );
                            ?>
                            <h2><?php the_title(); ?></h2>
                            <?php if ( $cliente ) : ?>
                                <p>Cliente: <span><?php echo esc_html( $cliente ); ?></span></p>
                            <?php endif; ?>
                            <?php if ( $cliente ) : ?>
                                <p>Área de Atuação: <span>
                                <?php 
                                    $term_names = array_column( $terms, 'name' );
                                    echo esc_html( implode( ', ', $term_names ) ); 
                                ?>
                                </span></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if ($marca_url) : ?>
                                <div class="breadcrumbs-logo-box">
                                    <img src="<?php echo esc_url($marca_url); ?>" alt="Logo <?php echo esc_attr($cliente); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <section id="portfolio-details" class="portfolio-details">
                <div class="container">
                    <div class="row justify-content-between gy-4 mt-4">
                        <div class="col-lg-12">
                            <div class="">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="img-fluid" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </div>
                            <div class="portfolio-description">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="">
                <div class="container">
                    <div class="section-header">
                        <h2>Veja como ficou o projeto</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <?php 
                            // Busca o ID da imagem do site que foi salva
                            $site_img_id = get_post_meta( get_the_ID(), '_bandeiragroup_site_img_id', true );
                            $site_img_url = wp_get_attachment_url( $site_img_id );

                            // Se a imagem do site foi cadastrada, exibe-a dentro do monitor
                            if ( $site_img_url ) : ?>
                                <div class="monitor-container">
                                    <div class="monitor-screen">
                                        <img src="<?php echo esc_url( $site_img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?> | Visualização do Site" class="monitor-image">
                                        <div class="monitor-scrollbar">
                                            <div class="monitor-scroller"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            // Caso contrário, exibe a imagem destacada como fallback
                            else :
                                the_post_thumbnail( 'full', ['class' => 'img-fluid'] ); 
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <section id="portfolio-features" class="portfolio-features section-bg">
                <div class="container">
                    <div class="row mt-4">
                        <?php
                        $recursos = get_the_terms( get_the_ID(), 'recursos' );
                        if ( ! empty( $recursos ) && ! is_wp_error( $recursos ) ) :
                            foreach ( $recursos as $recurso ) : ?>
                            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-4 mt-md-0">
                                <div class="icon-box">
                                    <i class="bi bi-check2-all"></i>
                                    <span><?php echo esc_html( $recurso->name ); ?></span>
                                </div>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </section>

            
        <?php endwhile; ?>
    <?php endif; ?>

    <section id="cta" class="cta">
    <div class="container" data-aos="zoom-out">
        <div class="row g-5">
            <div class="col content">
                <h3>Agende uma avaliação <em>gratuita!</em></h3>
                <a class="cta-btn align-self-start" href="<?php echo esc_url( home_url( '/contato' ) ); ?>"> Converse com um especialista agora <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

</main><?php get_footer(); ?>