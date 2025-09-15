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
                                // Busca os campos personalizados do novo metabox
                                $marca_id = get_post_meta( get_the_ID(), '_bandeiragroup_marca_id', true );
                                $marca_url = wp_get_attachment_url( $marca_id );
                                
                                // Busca a nova taxonomia 'tipo-portfolio'
                                $tipos_portfolio = get_the_terms( get_the_ID(), 'tipo-portfolio' );
                                $formatted_types = '';

                                if ( ! empty( $tipos_portfolio ) && ! is_wp_error( $tipos_portfolio ) ) {
                                    $term_names = array();
                                    foreach ($tipos_portfolio as $tipo) {
                                        $term_names[] = esc_html($tipo->name);
                                    }

                                    $count = count($term_names);
                                    if ($count === 1) {
                                        $formatted_types = $term_names[0];
                                    } elseif ($count === 2) {
                                        $formatted_types = implode(' e ', $term_names);
                                    } else {
                                        $last_term = array_pop($term_names);
                                        $formatted_types = implode(', ', $term_names) . ' e ' . $last_term;
                                    }
                                }
                            ?>
                            <?php if ( ! empty( $formatted_types ) ) : ?>
                                <h2><?php echo $formatted_types; ?></h2>
                            <?php endif; ?>
                            <p>Cliente: <span><?php the_title(); ?></span></p>
                            <?php 
                                // Busca as Áreas de Atuação
                                $area_atuacao = get_the_terms( get_the_ID(), 'area-atuacao' );
                            ?>
                            <?php if ( ! empty( $area_atuacao ) && ! is_wp_error( $area_atuacao ) ) : ?>
                                <p>Área de Atuação: <span>
                                <?php 
                                    $term_names = array_column( $area_atuacao, 'name' );
                                    echo esc_html( implode( ', ', $term_names ) ); 
                                ?>
                                </span></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if ($marca_url) : ?>
                                <div class="breadcrumbs-logo-box">
                                    <img src="<?php echo esc_url($marca_url); ?>" alt="Logo <?php echo esc_attr(get_the_title()); ?>">
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
                <h3>Receba um diagnóstico <em>gratuito</em></h3>
                <a class="cta-btn align-self-start" href="<?php echo esc_url( home_url( '/contato' ) ); ?>"> Converse com um especialista agora <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

</main><?php get_footer(); ?>