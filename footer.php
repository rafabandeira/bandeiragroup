<footer id="footer" class="footer">
        
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-info">
                        <?php
                            $whatsapp_number_formatted = get_option( 'bandeiragroup_contact_whatsapp' );
                            $whatsapp_number_clean = clean_whatsapp_number( $whatsapp_number_formatted );
                        ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/bandeiragroup-branca.png' ); ?>" alt="BandeiraGroup" style="margin-left: -25px;">
                            <p><strong>Endereço: </strong><?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_address' ) ) ); ?></p>
                            <a href="https://wa.me/55<?php echo esc_attr( $whatsapp_number_clean ); ?>" target="_blank" class="whatsapp-link"><p><strong>WhatsApp: </strong><?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_whatsapp' ) ) ); ?></p></a>
                            <a href="mailto:<?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_email' ) ) ); ?>" target="_blank"><p><strong>Email: </strong><?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_email' ) ) ); ?></p></a>
                            </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Links</h4>
                        <ul>
                            <li class="d-none"><i class="bi bi-chevron-right"></i> <a href="#quemsomos">Quem Somos</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#servicos">Serviços</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#portfolio">Portfólio</a></li>
                            <li class="d-none"><i class="bi bi-chevron-right"></i> <a href="#equipe">Equipe</a></li>
                            <li class="d-none"><i class="bi bi-chevron-right"></i> <a href="blog.html">Blog</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Serviços</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Design Gráfico</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-legal text-center">
            <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <div class="copyright">
                        &copy; Copyright <?php echo date('Y'); ?> - <strong><span><?php bloginfo('name'); ?></span></strong>. Todos os direitos reservados
                    </div>
                </div>
                <div class="social-links order-first order-lg-last mb-3 mb-lg-0 d-none">
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
        
    </footer><a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
    <div id="preloader"></div>
    
    <?php wp_footer(); ?>
    
</body>
</html>