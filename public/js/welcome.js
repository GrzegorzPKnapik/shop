$('.add-to-cart').click(function(event) {
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: DATA.addToCartUrl + $(this).data('id')
    })
        .done(function (response) {
            Swal.fire({
                title: 'Brawo!',
                text: response.message,
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-cart-plus"></i> Przejdź do koszyka',
                cancelButtonText: '<i class="fas fa-shopping-bag"></i> Kontynuuj zakupy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = DATA.cart;
                }
            })
        })
        .fail(function () {
            Swal.fire('Oops...', 'Wystąpił błąd', 'error');
        });
});
