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
                    <?php 
                        // Busca os campos personalizados
                        $cliente = get_post_meta( get_the_ID(), '_bandeiragroup_cliente', true );
                        $marca_id = get_post_meta( get_the_ID(), '_bandeiragroup_marca_id', true );
                        $marca_url = wp_get_attachment_url( $marca_id );
                        // Busca as Áreas de Atuação
                        $terms = get_the_terms( get_the_ID(), 'area-atuacao' );
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2><?php the_title(); ?></h2>
                        <?php if ( $cliente ) : ?>
                            <p><strong>Cliente</strong>: <?php echo esc_html( $cliente ); ?></p>
                        <?php endif; ?>

                        <ol>
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                            <li><a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>">Portfólio</a></li>
                            <li><?php the_title(); ?></li>
                        </ol>
                    </div>
                </div>
            </section>

            <section id="portfolio-details" class="portfolio-details">

                <div class="container">

                    <div class="row justify-content-between gy-4 mt-4">

                        <div class="col-lg-8">
                            <div class="portfolio-details-slider swiper">
                                <div class="swiper-wrapper align-items-center">
                                    <div class="swiper-slide">
                                        <?php 
                                        // Exibe a imagem destacada
                                        the_post_thumbnail( 'full', ['class' => 'img-fluid'] ); 
                                        ?>
                                    </div>
                                    </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="portfolio-info">
                                <?php 
                                // Busca os campos personalizados
                                $cliente = get_post_meta( get_the_ID(), '_bandeiragroup_cliente', true );
                                $marca_id = get_post_meta( get_the_ID(), '_bandeiragroup_marca_id', true );
                                $marca_url = wp_get_attachment_url( $marca_id );
                                
                                // Busca as Áreas de Atuação
                                $terms = get_the_terms( get_the_ID(), 'area-atuacao' );
                                ?>
                                <h3><?php the_title(); ?></h3>
                                <ul>
                                    <?php if ( $cliente ) : ?>
                                        <li><strong>Cliente</strong>: <?php echo esc_html( $cliente ); ?></li>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $terms ) ) : ?>
                                        <li><strong>Área de Atuação</strong>: 
                                            <?php 
                                            $term_names = array_column( $terms, 'name' );
                                            echo esc_html( implode( ', ', $term_names ) ); 
                                            ?>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ( $marca_url ) : ?>
                                        <li><strong>Marca</strong>: 
                                            <a href="<?php echo esc_url( $marca_url ); ?>" target="_blank">
                                                <img src="<?php echo esc_url( $marca_url ); ?>" alt="Logo <?php echo esc_attr( $cliente ); ?>" style="max-width: 100px;">
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            
                            <div class="portfolio-description">
                                <h2>Detalhes do Projeto</h2>
                                <?php 
                                // Exibe o conteúdo do campo 'Texto longo'
                                the_content(); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section><?php endwhile; ?>
    <?php endif; ?>

</main><?php get_footer(); ?>