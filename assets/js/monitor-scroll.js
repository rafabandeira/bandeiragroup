jQuery(document).ready(function($) {
  const monitorScreen = $('.monitor-screen');
  const monitorImage = $('.monitor-image');
  const monitorScroller = $('.monitor-scroller');

  if (monitorScreen.length && monitorImage.length) {
    
    // Calcula a altura do puxador
    const screenHeight = monitorScreen.innerHeight();
    const imageHeight = monitorImage[0].scrollHeight;
    const scrollbarHeight = monitorScreen.innerHeight() - 20; // Altura da barra
    const scrollerHeight = Math.max(10, (screenHeight / imageHeight) * scrollbarHeight);

    // Define a altura inicial do puxador
    monitorScroller.css('height', scrollerHeight + 'px');

    let isDragging = false;
    let startY = 0;
    let startPos = 0;

    // Evento de "mouse down": inicia o arraste
    monitorScreen.on('mousedown', function(e) {
      e.preventDefault();
      isDragging = true;
      startY = e.pageY;
      startPos = getTranslateY(monitorImage);
      $(this).css('cursor', 'grabbing');
    });

    // Evento de "mouse up": para o arraste
    $(document).on('mouseup', function() {
      if (isDragging) {
        isDragging = false;
        monitorScreen.css('cursor', 'grab');
      }
    });

    // Evento de "mouse move": move a imagem e o puxador
    monitorScreen.on('mousemove', function(e) {
      if (!isDragging) return;

      const deltaY = e.pageY - startY;
      let newImagePosition = startPos + deltaY;

      // Limita o movimento da imagem
      const maxScroll = imageHeight - screenHeight;
      if (newImagePosition > 0) newImagePosition = 0;
      if (newImagePosition < -maxScroll) newImagePosition = -maxScroll;

      // Calcula a nova posição do puxador
      const imageScrollRatio = -newImagePosition / maxScroll;
      const newScrollerPosition = imageScrollRatio * (scrollbarHeight - scrollerHeight);

      // Aplica as novas posições
      monitorImage.css('transform', 'translateY(' + newImagePosition + 'px)');
      monitorScroller.css('transform', 'translateY(' + newScrollerPosition + 'px)');
    });

    // Função auxiliar para obter o valor de translateY
    function getTranslateY(element) {
      const transform = element.css('transform');
      const matrix = transform.match(/^matrix\((.+)\)$/);
      if (matrix) {
        return parseFloat(matrix[1].split(', ')[5]);
      }
      return 0;
    }
  }
});