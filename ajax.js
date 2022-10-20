function successMessage(message) {
    var block =  document.querySelector('#success')
    block.append(message);
    block.style.display = 'block';
}

function errorMessage(message) {
    var block =  document.querySelector('#error')
    block.append(message);
    block.style.display = 'block';
}

$("document").ready(function() {
    $("#register").on("submit", function () {
        let serializeFormData = $(this).serialize();
        $.ajax({
            url: '/query.php',
            method: 'POST',
            dataType: 'html',
            data: serializeFormData,
            success: function (data) {
                document.querySelector('#error').style.display = 'none'
                document.querySelector('#error').innerHTML = ''
                console.log(data);
                switch(data){
                    case '0':
                        errorMessage("Ошибка: email не содержит @; пароли не совпадают");
                        break;
                    case '1':
                        errorMessage("Ошибка: пароли не совпадают");
                        break;
                    case '2':
                        errorMessage("Ошибка: email не содержит @");
                        break;
                    case '3':
                        document.querySelector('#register').style.display = 'none';
                        successMessage("Вы успешно зарегистрированы");
                        break;
                    case '7':
                        errorMessage("Пользователь с данным email уже зарегистрирован");
                        break;
                }
            },
            error: function (data) {
                alert('Внимание! произошла ошибка');
            }
        });
    })
});
