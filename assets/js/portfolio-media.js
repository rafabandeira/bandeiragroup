jQuery(document).ready(function($) {
    // Função para lidar com o upload da mídia
    $('.bandeiragroup-media-upload-button').on('click', function(e) {
        e.preventDefault();

        const button = $(this);
        const container = button.parent('.bandeiragroup-upload-container');
        const hiddenField = container.find('.bandeiragroup-media-upload-id');
        const previewContainer = container.find('.bandeiragroup-preview-container');

        // Cria a instância do frame de mídia
        const mediaUploader = wp.media({
            title: 'Selecione a Imagem da Marca',
            button: {
                text: 'Usar esta imagem'
            },
            multiple: false
        });

        // Quando um arquivo é selecionado
        mediaUploader.on('select', function() {
            const attachment = mediaUploader.state().get('selection').first().toJSON();

            // Atualiza o valor do campo oculto com o ID da imagem
            hiddenField.val(attachment.id);

            // Mostra o preview da imagem
            previewContainer.html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto; margin-top: 10px;">');
        });

        // Abre a biblioteca de mídia
        mediaUploader.open();
    });
});