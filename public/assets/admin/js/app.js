document.getElementById('CashClean').addEventListener('click', function (el){
    el.preventDefault();
    $.ajax(
        {
            url: document.getElementById('CashClean').getAttribute('href'),
            type: 'GET',
            data: {

            },
            success: function (response) {
                Swal.fire({
                    title: 'Кеш очищен!',
                    html: 'Кеш Вашего приложения успешно очищен',
                    icon: 'success',
                    timer: 1500
                })
            },
            error: function (response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Не удалось очистить кеш'
                })
            }
        });
})

if(document.getElementById('description')){
    $('#description').summernote({
        height: 300
    });
}

//Input -show file name
document.querySelectorAll('.custom-file-input').forEach(function (item) {
    item.addEventListener('change',function(e){
        let fileName = e.target.files[0].name;
        let nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
})
