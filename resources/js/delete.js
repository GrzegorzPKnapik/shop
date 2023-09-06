$(function() {
    $('.delete').click(function () {
        Swal.fire({
            title: 'Czy chcesz usunąć?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie',
            position: 'top'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: deleteUrl + $(this).data("id")

                })
                    .done(function (data) {
                        window.location.reload();
                    })
                    .fail(function (data) {
                        Swal.fire('Ops...', data.responseJSON.message, data.responseJSON.status);
                    });
            }
        });
    });
});
