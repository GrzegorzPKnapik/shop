$(function() {
        $(document).on("click", ".delete", function () {
        var id = $(this).data("id");
        Swal.fire({
            title: deleteConfirm,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie',
            position: 'center'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: deleteUrl + $(this).data("id"),
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".delete_mem" + id).fadeOut('slow');
                        //var script = document.createElement('script');
                      //  script.src = 'js/welcome.js';
                       // document.head.appendChild(script);
                       // script.onload = function () {
                            // Wywołaj tylko funkcję load() z pliku welcome.js
                            //loadSCMCAfterDelete();

                      //  };
                        $("#refresh").load(location.href + " #refresh");
                        $("#refreshSC").load(location.href + " #refreshSC");
                        loadMiniQuantity();

                    }
                })
                    .done(function (response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3500,
                        })
                        //window.location.reload();
                    })

                    .fail(function (response) {
                        //console.log(response);
                        Swal.fire('Ops...', response.responseJSON.message, response.responseJSON.status);
                    });
            }
        });
    });
});



function loadMiniQuantity() {
    $.ajax({
        type: "POST",
        url: "/load-cart-data",
        success: function (response) {
            $(".cart-count").html(response.count)

        }

    })
}
