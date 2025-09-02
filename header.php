<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container d-flex align-items-center justify-content-between">
            
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/bandeiragroup-logo.svg' ); ?>" alt="BandeiraGroup" height="50px">
            </a>
            
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="d-none nav-link scrollto" href="index.html#quemsomos">Quem Somos</a></li>
                    <li><a class="nav-link scrollto" href="index.html#servicos">Serviços</a></li>
                    <li><a class="nav-link scrollto" href="index.html#portfolio">Portfolio</a></li>
                    <li><a class="nav-link scrollto d-none" href="index.html#blog">Blog</a></li>
                    <li><a class="nav-link scrollto" href="index.html#contato">Contato</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><a class="btn-getstarted scrollto" href="https://wa.me/5571991438900" target="_blank">Orçamento</a>
            
        </div>
    </header>

