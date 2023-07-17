    $(document).ready(function() {
        // Agregar evento de clic a los elementos de categoría
        $('.list-group-item[data-toggle="collapse"]').click(function() {
            // Obtener el data-target del elemento clicado
            var target = $(this).data('target');
            
            // Ocultar todas las categorías excepto la que se clicó
            $('.collapse:not(' + target + ')').collapse('hide');
        });
    });

    