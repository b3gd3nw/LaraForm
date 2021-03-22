let items = document.querySelectorAll('.clear-btn');

items.forEach(function(item){
    item.onclick=function(){
        let id = this.getAttribute('id');
        document.getElementById("photo" + id).value = null;
        let event = new Event('change');
        document.getElementById("photo" + id).dispatchEvent(event);
    }
});
