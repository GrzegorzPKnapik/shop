$('.add-to-cart').click(function(event) {
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: WELCOME_DATA.addToCartUrl + $(this).data('id')
    })
        .done(function () {
            Swal.fire({
                title: 'Brawo!',
                text: 'Produkt dodany do koszyka!',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-cart-plus"></i> Przejdź do koszyka',
                cancelButtonText: '<i class="fas fa-shopping-bag"></i> Kontynuuj zakupy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = WELCOME_DATA.cart;
                }
            })
        })
        .fail(function () {
            Swal.fire('Oops...', 'Wystąpił błąd', 'error');
        });
});
