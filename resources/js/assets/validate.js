$.validator.addMethod("notNumber", function(value, element, param) {
    var reg = /[0-9]|[./?<>,;:{}!@#$%^&*()_+=-]/;
    if(reg.test(value)){
        return false;
    }else{
        return true;
    }
}, "Only letters.");


$(".submit").click(function (){
    let form = this.parentNode.getAttribute('id');
    $('#' + form).validate({
        rules: {
            firstname: {
                required: true,
                maxlength: 20,
                notNumber: true
            },
            lastname: {
                required: true,
                maxlength: 20,
                notNumber: true
            },
            birth_date: {
                required: true
            },
            report_subject: {
                required: true,
                maxlength: 255
            },
            country: {
                required: true,
                maxlength: 100
            },
            phone_number: {
                required: true
            },
            company: {
                maxlength: 200
            },
            position: {
                maxlength: 200
            },
            about: {
                maxlength: 200
            },
            photo: {
                extension: 'png|jpe?g|gif',
            },
        },
        messages: {
            photo: {
                extension: 'Only files .jpg, .png, allowed.'
            },
            email: {
                remote: 'Email already exists.'
            }
        }
    });
});



$('input[name="firstname"]').keypress(function(event){
    let inputValue = event.which;

    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
        event.preventDefault();
    }
});

$('input[name="lastname"]').keypress(function(event){
    let inputValue = event.which;
    // allow letters and whitespaces only.
    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
        event.preventDefault();
    }
});

$(document).on('change', 'input[name="photo"]', function () {
    if (this.files[0].size > 2000000) {
        $('#photo-size-error').html('File must be less than 2 mb.')
        $('#submit').prop('disabled', true)
    } else {
        $('#submit').prop('disabled', false)
        $('#photo-size-error').empty()
    }
})


