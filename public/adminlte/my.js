$('.delete').click(function(){
    var res = confirm('Вы действительно хотите удалить заказ?');
    if(!res) return false;
});

$('.del_category').click(function(){
    var res = confirm('Вы действительно хотите удалить категорию?');
    if(!res) return false;
});