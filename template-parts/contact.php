<section id="contato" class="contact">
      <div class="container">

        <div class="section-header">
          <h2>Contatos</h2>
          <p>Entre em contato conosco através do nosso WhatsApp ou preenchendo o formulário disponível, estamos ansiosos para te ouvir e ajudar no que for necessário.</p>
        </div>

      </div>

      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.494465594058!2d-38.46126362420189!3d-13.004153287314235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7161b642829f667%3A0xf0ffa7a20205fa3b!2sBandeiraGroup!5e0!3m2!1spt-BR!2sus!4v1689365529479!5m2!1spt-BR!2sus" frameborder="0" allowfullscreen></iframe>
      </div><div class="container">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            <div class="info">
              <h3>Vamos Conversar?</h3>
              <p>Estamos empolgados em fazer parte do seu sucesso online. Entre em contato conosco e deixe-nos ajudá-lo a construir um website impressionante, que traga resultados reais para o seu negócio.</p>
              <?php
                $whatsapp_number_formatted = get_option( 'bandeiragroup_contact_whatsapp' );
                $whatsapp_number_clean = clean_whatsapp_number( $whatsapp_number_formatted );
              ?>
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Endereço:</h4>
                  <p><?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_address' ) ) ); ?></p>
                </div>
              </div><div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <a href="mailto:<?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_email' ) ) ); ?>" target="_blank"><p><?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_email' ) ) ); ?></p></a>
                </div>
              </div><div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>WhatsApp:</h4>
                  <a href="https://wa.me/55<?php echo esc_attr( $whatsapp_number_clean ); ?>" target="_blank" class="whatsapp-link"><p><?php echo nl2br( esc_html( get_option( 'bandeiragroup_contact_whatsapp' ) ) ); ?></p></a>
                </div>
              </div></div>

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Seu Nome" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" placeholder="Mensagem" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Enviando</div>
                <div class="error-message"></div>
                <div class="sent-message">Sua mensagem foi enviada. Obrigado!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar</button></div>
            </form>
          </div></div>

      </div>
    </section>