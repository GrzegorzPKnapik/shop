$(function(){
    $('.delete').click(function (){
        if(confirm("Usunąć produktuu? Id:"+$(this).data("id") + " Nazwa:" + $(this).data("name"))){
            $.ajax({
                type: "DELETE",
                url: deleteUrl + $(this).data("id")
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
