/* Скрипт Корзины*/

$('body').on('click', '.add-to-cart-link', function (e) {
    e.preventDefault(); // Отключаем стандартный клик по ссылке, что бы не было перехода по ссылке
    let id = $(this).data('id'),
        quantity = $('.quantity input').val() ? $('.quantity input').val() : 1,
        modification = $('.available select').val();
    // console.log(id);
    // console.log(quantity);
    // console.log(modification);

    $.ajax({
        url: path + '/cart/add',
        data: {id:id,qty:quantity,mod:modification},
        type:'GET',
        success:function (res) {
            showCart(res);
        },
        error:function () {
            alert('Ошибка. Попробуйте позже!');
        }
    });
});

function showCart(response){
    if($.trim(response) == '<h3>Корзина пуста</h3>'){
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    }else{
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(response);
    $('#cart').modal();
}
/* Конец Скрипта Корзины*/

/* Скрипт для отображения стоимости товара при изменении цвета товара*/
// Получаем базовую цену товара и старую цену товара
let base_price = $('#base-price').data('base');
let old_base_price = $('#base-price').find('del').data('old');

// console.log('Базовая цена = ' + base_price);
// console.log('Старая цена = ' + old_base_price);

$('.available select').on('change', function () {
    let modID = $(this).val(),
        color = $(this).find('option').filter(':selected').data('title'),
        price = $(this).find('option').filter(':selected').data('price');

    if (price) {
        $('#base-price').text(symbol_left + price + symbol_right);
    } else {
        if (old_base_price) {
            $('#base-price').empty();
            $('#base-price').append(symbol_left + base_price + symbol_right + ' ');
            $('#base-price').append('<small><del data-old="' + old_base_price + '">' + symbol_left + old_base_price + symbol_right + '</del></small>');
        } else {
            $('#base-price').empty();
            $('#base-price').text(symbol_left + base_price + symbol_right);
        }

    }

    // console.log(modID);
    // console.log(color);
    // console.log(price);
});