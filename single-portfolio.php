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


            <div class="portfolio-description mt-5">
    <h3>Recursos do Projeto</h3>
    <div class="row">
    <?php
    $recursos = get_the_terms( get_the_ID(), 'recursos' );
    if ( ! empty( $recursos ) && ! is_wp_error( $recursos ) ) :
        foreach ( $recursos as $recurso ) : ?>
            <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center mb-2">
                <i class="bi bi-check2-all me-2" style="font-size: 1.2rem; color: var(--color-primary);"></i>
                <span><?php echo esc_html( $recurso->name ); ?></span>
            </div>
        <?php endforeach;
    endif; ?>
    </div>
</div>



            <section id="portfolio-features" class="portfolio-features section-bg">
                <div class="container">
                    <div class="row mt-4">
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                            <div class="icon-box">
                                <i class="bi bi-check2-all"></i>
                                <span>Certificado de Segurança SSL</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="icon-box">
                                <i class="bi bi-check2-all"></i>
                                <span>Gerenciador de Conteúdo (CMS)</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                            <div class="icon-box">
                                <i class="bi bi-check2-all"></i>
                                <span>Hospedagem na Nuvem</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                            <div class="icon-box">
                                <i class="bi bi-check2-all"></i>
                                <span>Integração</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4">
                            <div class="icon-box">
                                <i class="bi bi-check2-all"></i>
                                <span>Layout exclusivo</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4">
                            <div class="icon-box">
                                <i class="bi bi-check2-all"></i>
                                <span>Responsivo, navegável em todos dispositivos</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4">
                            <div class="icon-box">
                                <i class="bi bi-check2-all"></i>
                                <span>SEO Friendly</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        <?php endwhile; ?>
    <?php endif; ?>

</main><?php get_footer(); ?>