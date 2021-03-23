import Inputmask from "inputmask";
let im = new Inputmask("+9(999) 999-9999");
let target;
let user_photo;
$('.load-ajax-modal').click(function(){
   target = this.getAttribute('id');
    axios.get(
        $(this).data('path'))
        .then(responce=> {
            $('div.modal-body' + target).html(responce.data.view);
            im.mask('.phone');
            $('input[name="birthdate"]').datepicker({
                format: 'yyyy-mm-dd',
                endDate: '-1d'
            });
        });
});

$(document).on('change', 'input[name="photo"]', function() {
    let f = this.files[0];
    var reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {
            $(".user_photo_prev").attr("src", e.target.result);
        };
    })(f);
    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
});

$(document).on('click', '.clear-btn', function () {
    console.log(2);
    let id = this.getAttribute('id');
    console.log(1);
    document.getElementById("photo" + id).value = null;
    let event = new Event('change');
    document.getElementById("photo" + id).dispatchEvent(event);
    axios.get(
        $(this).data('path'))
        .then(responce=> {
            $(".user_photo_prev").attr("src", "/storage/" + responce.data);
        });
});
