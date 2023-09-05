$(function(){
    $('.delete').click(function (){
        if(confirm("Usunąć produkt? Id:"+$(this).data("id") + " Nazwa:" + $(this).data("name"))){
            $.ajax({
                type: "DELETE",
                url: "http://127.0.0.1:8000/product/" + $(this).data("id")
                //data: { id: $}
            })
                .done(function( response ) {
                    window.location.reload();
                })
                .fail(function( response ) {
                    alert( "ERROR");
                });
        }
    });
});
