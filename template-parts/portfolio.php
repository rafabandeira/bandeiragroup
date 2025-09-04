<section id="portfolio" class="portfolio" data-aos="fade-up">

    <div class="container">

        <div class="section-header">
            <h2>Portfólio</h2>
            <p>Conheça alguns dos trabalhos que fizemos para empresas de diversos segmentos.</p>
        </div>

    </div>

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="200">

        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">

            <ul class="portfolio-flters">
                <li data-filter="*" class="filter-active">Todos</li>
                <?php
                // Busca todas as 'Áreas de Atuação' (taxonomia)
                $areas = get_terms([
                    'taxonomy'   => 'area-atuacao',
                    'hide_empty' => true, // Exibe apenas categorias com posts
                ]);

                // Exibe os filtros de categoria
                if (!empty($areas) && !is_wp_error($areas)) {
                    foreach ($areas as $area) {
                        echo '<li data-filter=".filter-' . esc_attr($area->slug) . '">' . esc_html($area->name) . '</li>';
                    }
                }
                ?>
            </ul>
            <div class="row g-0 portfolio-container">

                <?php
                  // O loop do WordPress para o nosso Custom Post Type
                  $args = [
                      'post_type'      => 'portfolio',
                      'posts_per_page' => -1, // Exibe todos os itens
                  ];
                  $portfolio_query = new WP_Query($args);

                  if ($portfolio_query->have_posts()) :
                      while ($portfolio_query->have_posts()) : $portfolio_query->the_post();

                          // Busca as categorias do item do portfólio
                          $terms = get_the_terms(get_the_ID(), 'area-atuacao');
                          $classes = '';
                          if ($terms && !is_wp_error($terms)) {
                              foreach ($terms as $term) {
                                  $classes .= ' filter-' . $term->slug;
                              }
                          }

                          // Busca os campos personalizados
                          $cliente = get_post_meta(get_the_ID(), '_bandeiragroup_cliente', true);
                          $marca_id = get_post_meta(get_the_ID(), '_bandeiragroup_marca_id', true);
                          $marca_url = $marca_id ? wp_get_attachment_url($marca_id) : '';
                  ?>
                  <a href="<?php the_permalink(); ?>" title="Ver Detalhes"><div class="col-xl-3 col-lg-4 col-md-6 portfolio-item <?php echo esc_attr($classes); ?>">
                      <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="img-fluid" alt="<?php echo esc_attr(get_the_title()); ?>">
                      <div class="portfolio-info">
                          <h3><?php echo esc_html(get_the_title()); ?></h3>
                          <p><?php echo esc_html($cliente); ?></p>
                          
                      </div>
                      <?php if ($marca_url) : ?>
                          <div class="portfolio-logo-box">
                              <img src="<?php echo esc_url($marca_url); ?>" alt="Logo <?php echo esc_attr($cliente); ?>">
                          </div>
                      <?php endif; ?>
                  </div></a>
                  <?php
                    endwhile;
                    wp_reset_postdata(); // Restaura os dados globais do post
                else :
                    // Caso nenhum item de portfólio seja encontrado
                    echo '<p>Nenhum item de portfólio encontrado.</p>';
                endif;
                ?>

            </div></div>

    </div>

</section>





<section id="portfolio" class="portfolio d-none" data-aos="fade-up">

  <div class="container">

    <div class="section-header">
      <h2>Portfólio</h2>
      <p>Nossos trabalhos refletem o compromisso com a excelência e criatividade. Oferecendo soluções personalizadas em design gráfico, web design, identidade visual e marketing digital. Estamos orgulhosos de cada projeto concluído e ansiosos para continuar ajudando nossos clientes a alcançarem o sucesso desejado.</p>
    </div>

  </div>

  <div class="container-fluid" data-aos="fade-up" data-aos-delay="200">

    <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">

      <ul class="portfolio-flters">
        <li data-filter="*" class="filter-active">Todos</li>
        <li data-filter=".filtro-corp">Corporativo</li>
        <li data-filter=".filtro-politica">Política</li>
        <li data-filter=".filtro-portais">Portais</li>
      </ul><!-- End Portfolio Filters -->

      <div class="row g-0 portfolio-container">

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-politica">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-alessandra55.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Alessandra 55</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/alessandra55.jpg' ); ?>" title="Alessandra 55" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-allianceondina.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Alliance Ondina</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/allianceondina.jpg' ); ?>" title="Alliance Ondina" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filter-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-azietorres.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Azi & Torres Advogados Associados</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/azietorres.jpg' ); ?>" title="Azi & Torres Advogados Associados" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-portais">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-banews.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Portal Bahia News</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/banews.jpg' ); ?>" title="Portal Bahia News" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-barbeariaalphaville.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>ABarbearia Alphaville</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/barbeariaalphaville.jpg' ); ?>" title="Barbearia Alphaville" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-cdlogistica.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>CD Logística</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/cdlogistica.jpg' ); ?>" title="CD Logística" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filter-politica">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-cezar77.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Cezar 77</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/cezar77.jpg' ); ?>" title="Cezar 77" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-clinicathaysebrito.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Clínica Thayse Brito</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/clinicathaysebrito.jpg' ); ?>" title="Clínica Thayse Brito" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-clinicavitaly.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Clínica Vitaly</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/clinicavitaly.jpg' ); ?>" title="Clínica Vitaly" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-politica">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-clovisferraz55400.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Clóvis Ferraz 55400</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/clovisferraz55400.jpg' ); ?>" title="Clóvis Ferraz 55400" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filter-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-cnbavitraux.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>CNBA</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/cnbavitraux.jpg' ); ?>" title="CNBA" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-colegiomariahelena.jpg' ); ?>" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Colégio Maria Helena</h4>
            <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/colegiomariahelena.jpg' ); ?>" title="Colégio Maria Helena" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
          </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-politica">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-drandre1207.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>Dr. André 1207</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/drandre1207.jpg' ); ?>" title="Dr. André 1207" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-portais">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-enemp.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>ENEMP 2024</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/enemp.jpg' ); ?>" title="ENEMP 2024" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-expressocontabil.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>Expresso Contábil</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/expressocontabil.jpg' ); ?>" title="Expresso Contábil" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-fabricamoveisplanejados2.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>Fábrica Móveis Planejados</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/fabricamoveisplanejados2.jpg' ); ?>" title="Fábrica Móveis Planejados" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-gpstopografiaeprojetos.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>GPS Topografia e Projetos</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/gpstopografiaeprojetos.jpg' ); ?>" title="GPS Topografia e Projetos" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-jobsalvador.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>JOB Salvador</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/jobsalvador.jpg' ); ?>" title="JOB Salvador" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-jotafilho.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>J Filho Engenharia</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/jotafilho.jpg' ); ?>" title="J Filho Engenharia" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

        <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filtro-corp">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/thumb-mmcadvogados2.jpg' ); ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>MMC Advogados Associados</h4>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/portfolio/mmcadvogados2.jpg' ); ?>" title="MMC Advogados Associados" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="#" title="Mais detalhes" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div><!-- End Portfolio Item -->

    </div><!-- End Portfolio Container -->

    </div>

  </div>
</section><!-- End Portfolio Section -->
