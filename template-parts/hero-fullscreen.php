<?php
// Argumentos para a query que busca todos os posts de portfólio fixos.
$args = array(
    'post_type'      => 'portfolio',
    'posts_per_page' => -1, // Exibe todos os posts fixos
    'meta_key'       => '_bandeiragroup_is_sticky',
    'meta_value'     => '1',
    'post_status'    => 'publish',
);

// Cria uma nova instância da WP_Query.
$the_query = new WP_Query( $args );

// Inicia o loop para os posts fixos.
if ( $the_query->have_posts() ) :
?>
    <div id="hero-fullscreen" class="swiper">
        <div class="swiper-wrapper">

            <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                $background_style = '';
                if ($featured_image_url) {
                    $background_style = 'style="background-image: url(\'' . esc_url($featured_image_url) . '\');"';
                }
                // Busca a marca do cliente
                $marca_id = get_post_meta( get_the_ID(), '_bandeiragroup_marca_id', true );
                $marca_url = wp_get_attachment_url( $marca_id );
            ?>

            <section class="hero-fullscreen d-flex align-items-center swiper-slide" <?php echo $background_style; ?>>
                <div class="container d-flex flex-column align-items-center position-relative" data-aos="zoom-out">
                    <div class="row w-100 g-5">
                        <div class="col-lg-4">
                            <?php if ( $marca_url ) : ?>
                                <img src="<?php echo esc_url( $marca_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?> Logo" class="img-fluid" style="max-width: 100px;" >
                            <?php endif; ?>
                            <p><?php the_excerpt(); ?></p>
                            <div class="d-flex"><a href="<?php the_permalink(); ?>" class="btn-get-started">Ver este projeto</a></div>
                        </div>
                        <div class="col-lg-6 ms-auto">
                            <?php 
                            // Busca o ID da imagem do site que foi salva
                            $site_img_id = get_post_meta( get_the_ID(), '_bandeiragroup_site_img_id', true );
                            $site_img_url = wp_get_attachment_url( $site_img_id );

                            // Se a imagem do site foi cadastrada, exibe-a dentro do monitor
                            if ( $site_img_url ) : ?>
                                <div class="monitor-container">
                                    <div class="monitor-screen monitor-screen-hero">
                                        <img src="<?php echo esc_url( $site_img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?> | Visualização do Site" class="monitor-image">
                                        <div class="monitor-scrollbar">
                                            <div class="monitor-scroller"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php endwhile; ?>

        </div>
        <div class="swiper-pagination" style="bottom: 50px;"></div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('#hero-fullscreen', {
                speed: 300,
                loop: true,
                autoplay: {
                    delay: 10000,
                    disableOnInteraction: false
                },
                slidesPerView: 'auto',
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });
        });
    </script>

<?php
    wp_reset_postdata();

else :
    // Se nenhum post fixo for encontrado, exibe a seção hero padrão.
?>
    <div id="hero-fullscreen" class="swiper">
        <div class="swiper-wrapper">

            <section id="hero-fullscreen" class="hero-fullscreen d-flex align-items-center swiper-slide" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/assets/img/hero-2-bandeiragroup.jpg'); ?>) ;">
                <div class="container d-flex flex-column align-items-center position-relative" data-aos="zoom-out">
                    <div class="col-8 mx-auto">
                        <div class="badge bg-primary mb-3">Empresas locais</div>
                        <h2>Transforme seu <span>negócio local</span><br>com presença digital profissional</h2>
                        <p>Conectamos escritórios, clínicas e comércios aos seus clientes através de sites modernos e soluções digitais que geram resultados reais.</p>
                        <div class="d-flex">
                            <a href="https://wa.me/5571991438900" class="btn-get-started" target="_blank">Solicitar orçamento</a>
                        </div>
                    </div>
                </div>
            </section>
            <section id="hero-fullscreen" class="hero-fullscreen d-flex align-items-center swiper-slide" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/assets/img/hero-3-bandeiragroup.jpg'); ?>) ;">
                <div class="container d-flex flex-column align-items-center position-relative" data-aos="zoom-out">
                    <div class="col-8 mx-auto">
                        <div class="badge bg-primary mb-3">Orgulhosamente Baiano</div>
                        <h2>Tecnologia com <span>alma baiana</span><br>para o <span>mundo digital</span></h2>
                        <p>Da terra do axé e da inovação, levamos a criatividade e energia baiana para transformar negócios em todo o Brasil..</p>
                        <div class="d-flex">
                            <a href="https://wa.me/5571991438900" class="btn-get-started" target="_blank">Conheça nossa história</a>
                        </div>
                    </div>
                </div>
            </section>
            <section id="hero-fullscreen" class="hero-fullscreen d-flex align-items-center swiper-slide" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/assets/img/hero-4-bandeiragroup.jpg'); ?>) ;">
                <div class="container d-flex flex-column align-items-center position-relative" data-aos="zoom-out">
                    <div class="col-8 mx-auto">
                        <div class="badge bg-primary mb-3">Agências & Parceiros</div>
                        <h2>Parcerias que potencializam<br><span>resultados excepcionais</span></h2>
                        <p>Colaboramos com agências de propaganda, marketing e conteúdo para criar experiências digitais de alto nível que impressionam e convertem.</p>
                        <div class="d-flex">
                            <a href="https://wa.me/5571991438900" class="btn-get-started" target="_blank">Seja um parceiro</a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
<?php
endif;
?>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('#hero-fullscreen', {
                speed: 300,
                loop: true,
                autoplay: {
                    delay: 10000,
                    disableOnInteraction: false
                },
                slidesPerView: 'auto',
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });
        });
    </script>