$('.delete').click(function(){
    var res = confirm('Вы действительно хотите удалить заказ?');
    if(!res) return false;
});