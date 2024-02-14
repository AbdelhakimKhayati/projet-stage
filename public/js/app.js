$('#produit').on('input', function() {
    var query = $(this).val();
    if (query.length >= 2) {
        $.ajax({
            url: '/produits/search',
            method: 'GET',
            data: { query: query },
            success: function(response) {
                $('#produit-list').html(response);
            }
        });
    }
});
$(document).on('click', '.produit-item', function() {
    var produitId = $(this).data('id');
    var produitNom = $(this).text();
    $('#produit').val(produitNom);
    $('#produit_id').val(produitId);
    $('#produit-list').empty();
});
