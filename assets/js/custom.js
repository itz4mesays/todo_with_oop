let link = window.location
let baseUrl = link.pathname.split('/')[2].split('.php')
let fileName = baseUrl[0];

function clearSession(){
     // Write your business logic here
     $.ajax({
         type: 'POST',
         url: 'clear_sessions.php',
         data: {},
         success: (response) => {
             console.log(response)
         },
     })

    return false;
}

var isSubmitting = false

$(document).ready(function () {
    $('form').submit(function () {
        isSubmitting = true
    })

    $('form').data('initial-state', $('form').serialize());

    $(window).on('beforeunload', function () {
        if (!isSubmitting && $('form').serialize() != $('form').data('initial-state')) {
            
            return 'You have unsaved changes which will not be saved.'
        }else{
            clearSession();
        }
    });
})
