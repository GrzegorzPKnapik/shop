$(document).ready(function() {
    $('.delete').click(function() {
        var id = $(this).data("id");
        var deleteButton = $(this); // Zachowaj referencję do this

        if (confirm("Are you sure you want to delete this Member?")) {
            $.ajax({
                type: "DELETE",
                url: deleteUrl + id,
                data: ({
                    id: id
                }),
                cache: false,
                success: function(html) {
                    // Użyj deleteButton zamiast $(this) dla prawidłowej referencji
                    $(".delete_mem" + id).fadeOut('slow');
                }
            });
        } else {
            return false;
        }
    });
});
