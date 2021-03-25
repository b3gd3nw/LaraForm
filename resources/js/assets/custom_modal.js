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
    let ext = $(this).val().split('.').pop();
    let allow = new Array('jpeg','jpg','png');

    if ($.inArray(ext,allow) === -1) {
      $(".user_photo_prev").attr("src", "https://randomuser.me/api/portraits/lego/6.jpg");
    } else {
      let reader = new FileReader();
      // Closure to capture the file information.
      reader.onload = (function(theFile) {
          return function(e) {
              $(".user_photo_prev").attr("src", e.target.result);
          };
      })(f);
      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
});

$(document).on('click', '.clear-btn', function () {
    let id = this.getAttribute('id');
    document.getElementById("photo" + id).value = null;

    axios.get(
        $(this).data('path'))
        .then(responce=> {
            if (responce.data === false){
                $(".user_photo_prev").attr("src", "https://randomuser.me/api/portraits/lego/6.jpg");
            } else {
                $(".user_photo_prev").attr("src", "/storage/" + responce.data);
            }
        });
    $('.submit').prop('disabled', false)
    $('#photo-size-error').empty()
    let event = new Event('change');
    document.getElementById("photo" + id).dispatchEvent(event);
});

$(document).on('click', '.delete_photo', function () {
    axios.get(
        $(this).data('path'))
        .then(responce=> {
            $(".user_photo_prev").attr("src", "https://randomuser.me/api/portraits/lego/6.jpg");
        });
});
