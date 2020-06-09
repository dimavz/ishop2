$('.delete').click(function(){
    var res = confirm('Вы действительно хотите удалить заказ?');
    if(!res) return false;
});

$('.del_category').click(function(){
    var res = confirm('Вы действительно хотите удалить категорию?');
    if(!res) return false;
});

// Выделение активного пункта меню в админке
$('.sidebar-menu a').each(function(){
    var location = window.location.protocol + '//' + window.location.host + window.location.pathname;
    // console.log(location);
    var link = this.href;
    // console.log(link);
    if(link == location){
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
});