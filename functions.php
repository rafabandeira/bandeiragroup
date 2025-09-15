<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function bandeiragroup_scripts() {
    // Enfileira os estilos
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css', [], '5.3.2' );
    wp_enqueue_style( 'bootstrap-icons', get_template_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css', [], '1.9.1' );
    wp_enqueue_style( 'aos-css', get_template_directory_uri() . '/assets/vendor/aos/aos.css', [], '2.3.1' );
    wp_enqueue_style( 'glightbox-css', get_template_directory_uri() . '/assets/vendor/glightbox/css/glightbox.min.css', [], '3.2.0' );
    wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', [], '8.4.5' );
    wp_enqueue_style( 'variables-green-css', get_template_directory_uri() . '/assets/css/variables-green.css', [], wp_get_theme()->get('Version') );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css', [], wp_get_theme()->get('Version') );
    
    // Enfileira os scripts
    wp_enqueue_script( 'bootstrap-bundle', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', ['jquery'], '5.3.2', true );
    wp_enqueue_script( 'aos-js', get_template_directory_uri() . '/assets/vendor/aos/aos.js', [], '2.3.1', true );
    wp_enqueue_script( 'glightbox-js', get_template_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js', [], '3.2.0', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/vendor/isotope-layout/isotope.pkgd.min.js', ['jquery'], '3.0.6', true );
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', [], '8.4.5', true );
    wp_enqueue_script( 'php-email-form-validate', get_template_directory_uri() . '/assets/vendor/php-email-form/validate.js', [], null, true );
    
    // JS principal do tema
    wp_enqueue_script( 'bandeiragroup-main-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery', 'bootstrap-bundle', 'aos-js', 'glightbox-js', 'isotope', 'swiper'], wp_get_theme()->get('Version'), true );
    
    // Configurações do Google Analytics
    wp_enqueue_script( 'google-gtag', 'https://www.googletagmanager.com/gtag/js?id=G-C65NK3MMLN', [], null, false );
    wp_add_inline_script( 'google-gtag', "window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-C65NK3MMLN');", 'after' );
}
add_action( 'wp_enqueue_scripts', 'bandeiragroup_scripts' );

// Configuração do tema
function bandeiragroup_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );

}
add_action( 'after_setup_theme', 'bandeiragroup_setup' );


// Garante que o WordPress não crie tamanhos de imagem padrão.
function bandeiragroup_disable_big_image_scaling( $threshold ) {
    return false; // Retornar `false` desativa o limite de tamanho.
}
add_filter( 'big_image_size_threshold', 'bandeiragroup_disable_big_image_scaling' );



/**
 * Enfileira scripts e estilos para o painel de administração.
 */
function bandeiragroup_enqueue_admin_assets() {
    // Carrega o CSS do Bootstrap para o painel de administração
    wp_enqueue_style( 
        'bootstrap-admin-css', 
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', 
        [], 
        '5.3.2' 
    );
}
add_action( 'admin_enqueue_scripts', 'bandeiragroup_enqueue_admin_assets' );


/**
 * Registra uma nova página de menu para as opções de contato do tema.
 */
function bandeiragroup_register_contact_options_page() {
    add_menu_page(
        __( 'Opções de Contato', 'bandeiragroup' ), // Título da página
        __( 'Contatos', 'bandeiragroup' ), // Título do menu
        'manage_options', // Capacidade necessária para ver o menu
        'bandeiragroup-contact-settings', // Slug do menu
        'bandeiragroup_contact_options_page_html', // Função que renderiza o HTML da página
        'dashicons-phone', // Ícone do menu
        4 // Posição do menu
    );
}
add_action( 'admin_menu', 'bandeiragroup_register_contact_options_page' );
/**
 * Registra as configurações do menu de opções.
 */
function bandeiragroup_contact_settings_init() {
    // Registra a configuração de endereço
    register_setting( 'bandeiragroup-contact-settings-group', 'bandeiragroup_contact_address', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'default' => '',
    ] );

    // Registra a configuração de e-mail
    register_setting( 'bandeiragroup-contact-settings-group', 'bandeiragroup_contact_email', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_email',
        'default' => '',
    ] );

    // Registra a configuração de WhatsApp
    register_setting( 'bandeiragroup-contact-settings-group', 'bandeiragroup_contact_whatsapp', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '',
    ] );
}
add_action( 'admin_init', 'bandeiragroup_contact_settings_init' );
/**
 * Renderiza o HTML da página de opções de contato.
 */
function bandeiragroup_contact_options_page_html() {
    // Verifica se o usuário tem a capacidade necessária
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    // Exibe as mensagens de erro ou sucesso
    if ( isset( $_GET['settings-updated'] ) ) {
        settings_errors();
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Campos de segurança e grupos de configurações
            settings_fields( 'bandeiragroup-contact-settings-group' );
            do_settings_sections( 'bandeiragroup-contact-settings-group' );
            ?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="bandeiragroup_contact_address">Endereço</label></th>
                        <td>
                            <textarea id="bandeiragroup_contact_address" name="bandeiragroup_contact_address" class="large-text code"><?php echo esc_textarea( get_option( 'bandeiragroup_contact_address' ) ); ?></textarea>
                            <p class="description">Insira o endereço completo.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bandeiragroup_contact_email">Email</label></th>
                        <td>
                            <input type="email" id="bandeiragroup_contact_email" name="bandeiragroup_contact_email" value="<?php echo esc_attr( get_option( 'bandeiragroup_contact_email' ) ); ?>" class="regular-text">
                            <p class="description">Insira o email de contato.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bandeiragroup_contact_whatsapp">WhatsApp</label></th>
                        <td>
                            <input type="text" id="bandeiragroup_contact_whatsapp" name="bandeiragroup_contact_whatsapp" value="<?php echo esc_attr( get_option( 'bandeiragroup_contact_whatsapp' ) ); ?>" class="regular-text">
                            <p class="description">Insira o número de WhatsApp com DDD. Apenas números.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
            // Botão de salvar
            submit_button( 'Salvar Configurações' );
            ?>
        </form>
    </div>
    <?php
}
/**
 * Remove todos os caracteres não numéricos de uma string.
 *
 * @param string $number O número de telefone com ou sem formatação.
 * @return string O número de telefone apenas com dígitos.
 */
function clean_whatsapp_number( $number ) {
    return preg_replace( '/[^0-9]/', '', $number );
}







// ====================================================================
// START: CONFIGURAÇÃO DO PORTFÓLIO
// ====================================================================

// Registra o Custom Post Type 'Portfolio'
function bandeiragroup_register_portfolio_cpt() {
    $labels = [
        'name'               => _x( 'Portfólios', 'post type general name', 'meu-tema' ),
        'singular_name'      => _x( 'Portfólio', 'post type singular name', 'meu-tema' ),
        'menu_name'          => _x( 'Portfólio', 'admin menu', 'meu-tema' ),
        'name_admin_bar'     => _x( 'Portfólio', 'add new on admin bar', 'meu-tema' ),
        'add_new'            => _x( 'Adicionar Novo', 'book', 'meu-tema' ),
        'add_new_item'       => __( 'Adicionar Novo Portfólio', 'meu-tema' ),
        'new_item'           => __( 'Novo Portfólio', 'meu-tema' ),
        'edit_item'          => __( 'Editar Portfólio', 'meu-tema' ),
        'view_item'          => __( 'Ver Portfólio', 'meu-tema' ),
        'all_items'          => __( 'Todos os Portfólios', 'meu-tema' ),
        'search_items'       => __( 'Pesquisar Portfólios', 'meu-tema' ),
        'parent_item_colon'  => __( 'Portfólios Pais:', 'meu-tema' ),
        'not_found'          => __( 'Nenhum portfólio encontrado.', 'meu-tema' ),
        'not_found_in_trash' => __( 'Nenhum portfólio encontrado na lixeira.', 'meu-tema' ),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'portfolio' ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon'          => 'dashicons-portfolio',
        'show_in_rest'       => true,
    ];

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'bandeiragroup_register_portfolio_cpt' );


// Registra a Custom Taxonomy 'area-atuacao'
function bandeiragroup_register_area_atuacao_taxonomy() {
    $labels = [
        'name'              => _x( 'Áreas de Atuação', 'taxonomy general name', 'meu-tema' ),
        'singular_name'     => _x( 'Área de Atuação', 'taxonomy singular name', 'meu-tema' ),
        'search_items'      => __( 'Pesquisar Áreas de Atuação', 'meu-tema' ),
        'all_items'         => __( 'Todas as Áreas de Atuação', 'meu-tema' ),
        'parent_item'       => __( 'Área de Atuação Pai', 'meu-tema' ),
        'parent_item_colon' => __( 'Área de Atuação Pai:', 'meu-tema' ),
        'edit_item'         => __( 'Editar Área de Atuação', 'meu-tema' ),
        'update_item'       => __( 'Atualizar Área de Atuação', 'meu-tema' ),
        'add_new_item'      => __( 'Adicionar Nova Área de Atuação', 'meu-tema' ),
        'new_item_name'     => __( 'Nome da Nova Área de Atuação', 'meu-tema' ),
        'menu_name'         => __( 'Áreas de Atuação', 'meu-tema' ),
    ];

    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'area-de-atuacao' ],
        'show_in_rest'      => true,
    ];

    register_taxonomy( 'area-atuacao', [ 'portfolio' ], $args );
}
add_action( 'init', 'bandeiragroup_register_area_atuacao_taxonomy' );

// Registra a Custom Taxonomy 'recursos'
function bandeiragroup_register_recursos_taxonomy() {
    $labels = [
        'name'              => _x( 'Recursos', 'taxonomy general name', 'meu-tema' ),
        'singular_name'     => _x( 'Recurso', 'taxonomy singular name', 'meu-tema' ),
        'search_items'      => __( 'Pesquisar Recursos', 'meu-tema' ),
        'all_items'         => __( 'Todos os Recursos', 'meu-tema' ),
        'parent_item'       => __( 'Recurso Pai', 'meu-tema' ),
        'parent_item_colon' => __( 'Recurso Pai:', 'meu-tema' ),
        'edit_item'         => __( 'Editar Recurso', 'meu-tema' ),
        'update_item'       => __( 'Atualizar Recurso', 'meu-tema' ),
        'add_new_item'      => __( 'Adicionar Novo Recurso', 'meu-tema' ),
        'new_item_name'     => __( 'Nome do Novo Recurso', 'meu-tema' ),
        'menu_name'         => __( 'Recursos', 'meu-tema' ),
    ];

    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'recurso' ],
        'show_in_rest'      => true,
    ];

    register_taxonomy( 'recursos', [ 'portfolio' ], $args );
}
add_action( 'init', 'bandeiragroup_register_recursos_taxonomy' );

/**
 * Adiciona termos padrão na taxonomia 'recursos' na primeira ativação do tema.
 */
function bandeiragroup_set_default_portfolio_features() {
    $features = [
        'Certificado de Segurança SSL',
        'Gerenciador de Conteúdo (CMS)',
        'Hospedagem na Nuvem',
        'Integração',
        'Layout exclusivo',
        'Responsivo, navegável em todos dispositivos',
        'SEO Friendly',
    ];
    foreach ( $features as $feature ) {
        if ( ! term_exists( $feature, 'recursos' ) ) {
            wp_insert_term(
                $feature,
                'recursos',
                [
                    'slug' => sanitize_title( $feature )
                ]
            );
        }
    }
}
add_action( 'init', 'bandeiragroup_set_default_portfolio_features', 20 );

/**
 * Registra a nova taxonomia 'tipo-portfolio'.
 */
function bandeiragroup_register_portfolio_type_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Tipos de Portfólio', 'Taxonomy General Name', 'meu-tema' ),
        'singular_name'              => _x( 'Tipo de Portfólio', 'Taxonomy Singular Name', 'meu-tema' ),
        'menu_name'                  => __( 'Tipos', 'meu-tema' ),
        'all_items'                  => __( 'Todos os Tipos', 'meu-tema' ),
        'parent_item'                => __( 'Tipo Pai', 'meu-tema' ),
        'parent_item_colon'          => __( 'Tipo Pai:', 'meu-tema' ),
        'new_item_name'              => __( 'Novo Tipo', 'meu-tema' ),
        'add_new_item'               => __( 'Adicionar Novo Tipo', 'meu-tema' ),
        'edit_item'                  => __( 'Editar Tipo', 'meu-tema' ),
        'update_item'                => __( 'Atualizar Tipo', 'meu-tema' ),
        'view_item'                  => __( 'Ver Tipo', 'meu-tema' ),
        'separate_items_with_commas' => __( 'Separar tipos com vírgulas', 'meu-tema' ),
        'add_or_remove_items'        => __( 'Adicionar ou remover tipos', 'meu-tema' ),
        'choose_from_most_used'      => __( 'Escolher entre os mais usados', 'meu-tema' ),
        'popular_items'              => __( 'Tipos Populares', 'meu-tema' ),
        'search_items'               => __( 'Pesquisar Tipos', 'meu-tema' ),
        'not_found'                  => __( 'Nenhum tipo encontrado', 'meu-tema' ),
        'no_terms'                   => __( 'Nenhum tipo', 'meu-tema' ),
        'items_list'                 => __( 'Lista de Tipos', 'meu-tema' ),
        'items_list_navigation'      => __( 'Navegação da lista de tipos', 'meu-tema' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true, // Adicione esta linha!
    );
    register_taxonomy( 'tipo-portfolio', array( 'portfolio' ), $args );
}
add_action( 'init', 'bandeiragroup_register_portfolio_type_taxonomy' );

/**
 * Adiciona termos padrão na nova taxonomia.
 */
function bandeiragroup_add_default_portfolio_types() {
    $types = [ 'Website', 'Marca', 'Midias Sociais' ];
    foreach ( $types as $type ) {
        if ( ! term_exists( $type, 'tipo-portfolio' ) ) {
            wp_insert_term( $type, 'tipo-portfolio' );
        }
    }
}
add_action( 'init', 'bandeiragroup_add_default_portfolio_types', 20 );

// Registra um novo metabox para os campos de mídia
function bandeiragroup_add_portfolio_media_metabox() {
    add_meta_box(
        'bandeiragroup_portfolio_media',
        'Mídia do Portfólio',
        'bandeiragroup_portfolio_media_html',
        'portfolio',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'bandeiragroup_add_portfolio_media_metabox' );


// Renderiza o HTML para o novo metabox de mídia
function bandeiragroup_portfolio_media_html( $post ) {
    wp_nonce_field( 'bandeiragroup_save_portfolio_data', 'bandeiragroup_portfolio_nonce' );

    $marca_id = get_post_meta( $post->ID, '_bandeiragroup_marca_id', true );
    $marca_url = wp_get_attachment_url( $marca_id );
    $site_img_id = get_post_meta( $post->ID, '_bandeiragroup_site_img_id', true );
    $site_img_url = wp_get_attachment_url( $site_img_id );
    ?>
    
    <div class="row">
        <div class="col-lg-6 col-md-6 mb-4">
            <p>
                <label for="bandeiragroup_marca_logo">Marca do Cliente:</label>
                <br>
                <div class="bandeiragroup-upload-container">
                    <input type="hidden" id="bandeiragroup_marca_id" name="bandeiragroup_marca_id" value="<?php echo esc_attr( $marca_id ); ?>" class="bandeiragroup-media-upload-id">
                    <button class="button bandeiragroup-media-upload-button">Selecionar Marca</button>
                    <div class="bandeiragroup-preview-container">
                        <?php if ( $marca_url ) : ?>
                            <img src="<?php echo esc_url( $marca_url ); ?>" style="max-width: 300px; height: auto; margin-top: 10px;">
                        <?php endif; ?>
                    </div>
                </div>
            </p>
        </div>

        <div class="col-lg-6 col-md-6 mb-4">
            <p>
                <label for="bandeiragroup_site_img">Imagem do Site:</label>
                <br>
                <div class="bandeiragroup-upload-container">
                    <input type="hidden" id="bandeiragroup_site_img_id" name="bandeiragroup_site_img_id" value="<?php echo esc_attr( $site_img_id ); ?>" class="bandeiragroup-media-upload-id">
                    <button class="button bandeiragroup-media-upload-button">Selecionar Imagem do Site</button>
                    <div class="bandeiragroup-preview-container">
                        <?php if ( $site_img_url ) : ?>
                            <img src="<?php echo esc_url( $site_img_url ); ?>" style="max-width: 100%; height: auto; margin-top: 10px;">
                        <?php endif; ?>
                    </div>
                </div>
            </p>
        </div>
    </div>
    <?php
}


// Salva os campos personalizados do novo metabox
function bandeiragroup_save_portfolio_media_data( $post_id ) {
    if ( ! isset( $_POST['bandeiragroup_portfolio_nonce'] ) || ! wp_verify_nonce( $_POST['bandeiragroup_portfolio_nonce'], 'bandeiragroup_save_portfolio_data' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Salva o ID da imagem da marca
    if ( isset( $_POST['bandeiragroup_marca_id'] ) ) {
        $marca_id = absint( $_POST['bandeiragroup_marca_id'] );
        update_post_meta( $post_id, '_bandeiragroup_marca_id', $marca_id );
    }

    // Salva o ID da imagem do site
    if ( isset( $_POST['bandeiragroup_site_img_id'] ) ) {
        $site_img_id = absint( $_POST['bandeiragroup_site_img_id'] );
        update_post_meta( $post_id, '_bandeiragroup_site_img_id', $site_img_id );
    }
}
add_action( 'save_post', 'bandeiragroup_save_portfolio_media_data' );


// Enfileira o script para o metabox do Portfólio.
function bandeiragroup_enqueue_portfolio_media_script() {
    $screen = get_current_screen();
    if ( is_object( $screen ) && 'portfolio' === $screen->post_type ) {
        wp_enqueue_media();
        wp_enqueue_script(
            'bandeiragroup-portfolio-media-uploader',
            get_template_directory_uri() . '/assets/js/portfolio-media.js',
            ['jquery'],
            wp_get_theme()->get('Version'),
            true
        );
    }
}
add_action( 'admin_enqueue_scripts', 'bandeiragroup_enqueue_portfolio_media_script' );


// Enfileira o script para monitorar o scroll na página single-portfolio.
function bandeiragroup_enqueue_monitor_script() {
    if ( is_singular( 'portfolio' ) ) {
        wp_enqueue_script(
            'bandeiragroup-monitor-scroll',
            get_template_directory_uri() . '/assets/js/monitor-scroll.js',
            ['jquery'],
            wp_get_theme()->get('Version'),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'bandeiragroup_enqueue_monitor_script' );

// Adiciona o metabox para o banner inicial.
function bandeiragroup_add_sticky_metabox() {
    add_meta_box(
        'bandeiragroup_sticky_info',
        'Fixar no Hero',
        'bandeiragroup_sticky_info_html',
        'portfolio',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'bandeiragroup_add_sticky_metabox' );

// HTML do metabox.
function bandeiragroup_sticky_info_html( $post ) {
    wp_nonce_field( 'bandeiragroup_save_sticky_data', 'bandeiragroup_sticky_nonce' );
    $is_sticky = get_post_meta( $post->ID, '_bandeiragroup_is_sticky', true );
    ?>
    <p>
        <label for="bandeiragroup_is_sticky">
            <input type="checkbox" id="bandeiragroup_is_sticky" name="bandeiragroup_is_sticky" value="1" <?php checked( $is_sticky, '1' ); ?>>
            Fixar no Hero.
        </label>
    </p>
    <?php
}

// Salva o status fixo do post.
function bandeiragroup_save_sticky_data( $post_id ) {
    if ( ! isset( $_POST['bandeiragroup_sticky_nonce'] ) || ! wp_verify_nonce( $_POST['bandeiragroup_sticky_nonce'], 'bandeiragroup_save_sticky_data' ) ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    $is_sticky_value = isset( $_POST['bandeiragroup_is_sticky'] ) ? 1 : 0;
    update_post_meta( $post_id, '_bandeiragroup_is_sticky', $is_sticky_value );
}
add_action( 'save_post', 'bandeiragroup_save_sticky_data' );

// ====================================================================
// END: CONFIGURAÇÃO DO PORTFÓLIO
// ====================================================================




/////////////////////////////////////////////////////////
// Verificar atualizações do tema via servidor pessoal //
/////////////////////////////////////////////////////////
delete_site_transient('update_themes');
function update_checker( $transient ) {
    if ( empty( $transient->checked ) ) {
        return $transient;
    }
    // URL do JSON de atualizações
    $remote_json = 'https://raw.githubusercontent.com/rafabandeira/bandeiragroup/refs/heads/main/bandeiragroup.json';
    // Buscar dados do JSON
    $response = wp_remote_get( $remote_json, array(
        'timeout' => 10,
        'headers' => array( 'Accept' => 'application/json' )
    ) );
    // Se houver erro, retorne o transient original
    if ( is_wp_error( $response ) ) {
        return $transient;
    }
    // Verifica se a resposta é válida
    if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
        return $transient;
    }
    // Decodificar JSON
    $remote_data = json_decode( wp_remote_retrieve_body( $response ) );
    // Verificar se a decodificação foi bem-sucedida e se os campos necessários estão presentes
    if ( json_last_error() !== JSON_ERROR_NONE || ! isset( $remote_data->version, $remote_data->details_url, $remote_data->download_url ) ) {
        return $transient; // Retornar o transient original se houver erro na decodificação ou campos ausentes
    }
    // Identificar slug e versão do tema
    $theme_slug = get_template(); // Slug do tema (nome da pasta)
    $current_version = wp_get_theme( $theme_slug )->get( 'Version' );
    // Comparar versões
    if ( version_compare( $current_version, $remote_data->version, '<' ) ) {
        $transient->response[ $theme_slug ] = array(
            'theme'        => $theme_slug,
            'new_version'  => $remote_data->version,
            'details_url'  => esc_url( $remote_data->details_url ),
            'package'      => esc_url( $remote_data->download_url ),
        );
    }
    return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'update_checker' );
// Garantir que o código funcione em Multisite
function update_checker_multisite_network() {
    if ( is_multisite() ) {
        $sites = get_sites();
        foreach ( $sites as $site ) {
            switch_to_blog( $site->blog_id );
            // Executar o código de verificação para cada site
            $transient = get_site_transient( 'update_themes' );
            $transient = update_checker( $transient );
            set_site_transient( 'update_themes', $transient );
            restore_current_blog();
        }
    }
}
add_action( 'admin_init', 'update_checker_multisite_network' );





/**
 * Remove o prefixo do título da página de arquivo.
 * Por exemplo: 'Categoria: Categoria do Blog' se torna 'Categoria do Blog'
 */
function bandeiragroup_remove_archive_title_prefix( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'bandeiragroup_remove_archive_title_prefix' );