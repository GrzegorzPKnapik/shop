$(function() {
    $('.delete').click(function () {
        Swal.fire({
            title: deleteConfirm,
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
                    .done(function (response) {
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3500
                        }).then(() => {
                                window.location.reload();
                            });
                        })

                    .fail(function (response) {
                        //console.log(response);
                        Swal.fire('Ops...', response.responseJSON.message, response.responseJSON.status);
                    });
            }
        });
    });
});
