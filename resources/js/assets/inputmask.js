import Inputmask from "inputmask";

let phone_fields = document.querySelectorAll('input[name=\"phone\"]');
let im = new Inputmask("+9(999) 999-9999");
phone_fields.forEach(function (phoneItem){
    im.mask(phoneItem);
});


