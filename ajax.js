$("document").ready(function() {

    $("#register").on("submit", function () {
        let serializeFormData = $(this).serialize();

        $.ajax({
            url: '/query.php',
            method: 'POST',
            dataType: 'html',
            data: serializeFormData,
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                alert('Внимание! произошла ошибка');
            }
        });
    })
})