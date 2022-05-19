document.addEventListener('DOMContentLoaded', function () {
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });
})