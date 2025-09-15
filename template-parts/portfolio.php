<?php
// O loop do WordPress para o nosso Custom Post Type
$args = [
    'post_type'      => 'portfolio',
    'posts_per_page' => -1, // Exibe todos os itens
];
$portfolio_query = new WP_Query($args);

// Somente exibe a seção se houver posts de portfólio
if ($portfolio_query->have_posts()) :
?>

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
                $args = [
                    'post_type'      => 'portfolio',
                    'posts_per_page' => -1,         // Exibe todos os posts
                    'post_status'    => 'publish',
                    'orderby'        => 'title',    // Ordena por título
                    'order'          => 'ASC'       // Em ordem ascendente (alfabética)
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
                          $marca_id = get_post_meta(get_the_ID(), '_bandeiragroup_marca_id', true);
                          $marca_url = $marca_id ? wp_get_attachment_url($marca_id) : '';
                  ?>
                  <a href="<?php the_permalink(); ?>" title="Ver Detalhes"><div class="col-xl-3 col-lg-4 col-md-6 portfolio-item <?php echo esc_attr($classes); ?>">
                      <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="img-fluid" alt="<?php echo esc_attr(get_the_title()); ?>">
                      <div class="portfolio-info">
                          <h3>
                            <?php
                              $terms = get_the_terms(get_the_ID(), 'tipo-portfolio');
                              // Verifica se há termos e se não houve erro.
                              if (!empty($terms) && !is_wp_error($terms)) {
                                  // Cria um array para armazenar os nomes dos termos.
                                  $term_names = array();
                                  foreach ($terms as $term) {
                                      $term_names[] = esc_html($term->name);
                                  }
                                  // Cria a string formatada com vírgulas e 'e'.
                                  $formatted_string = '';
                                  $count = count($term_names);
                                  if ($count === 1) {
                                      $formatted_string = $term_names[0];
                                  } elseif ($count === 2) {
                                      $formatted_string = implode(' e ', $term_names);
                                  } else {
                                      $last_term = array_pop($term_names);
                                      $formatted_string = implode(', ', $term_names) . ' e ' . $last_term;
                                  }
                                  echo $formatted_string;
                              }
                            ?>  
                          </h3>
                          <p><?php echo esc_html(get_the_title()); ?></p>
                          
                      </div>
                      <?php if ($marca_url) : ?>
                          <div class="portfolio-logo-box">
                              <img src="<?php echo esc_url($marca_url); ?>" alt="Logo <?php echo esc_html(get_the_title()); ?>">
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

<?php endif; ?>