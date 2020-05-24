/* Filters */
$('body').on('change', '.w_sidebar input', function(){
    var checked = $('.w_sidebar input:checked'),
        data = '';
    checked.each(function () {
        data += this.value + ',';
    });
    // console.log(data);
    if(data){
        $.ajax({
            url: location.href,
            data: {filter: data},
            type: 'GET',
            beforeSend: function(){ // Перед отправкой запроса показываем прелоадер
                $('.preloader').fadeIn(300, function(){ // Показываем прелоадер
                    $('.product-one').hide(); // и скрываем продукты
                });
            },
            success: function(res){
                $('.preloader').delay(500).fadeOut('slow', function(){ // Скрываем прелоадер
                    $('.product-one').html(res).fadeIn(); //и показываем результат запроса
                    //Определяем переменную url
                    //обращаясь к объекту location и его методу search мы удаляем при помощи регулярного выражения строку /filter далее что угодно (.+?) до знака амперсанда или до конца строки (&|$)
                    var url = location.search.replace(/filter(.+?)(&|$)/g, ''); //$2

                    //Определяем переменную newURL
                    //обращаясь к объекту location и его методу pathname мы добавляем url сформированный на предыдущем этапе
                    //далее у нас идёт тернарный оператор при помощи которого мы смотрим имеется ли в объекте location метод search (location.search)
                    //проще говоря имеются ли GET параметры в url
                    //если таковые имеются, то мы их добавляем к текущим при помощи амперсанда (&), если нет, тогда мы добавляем знак (?)
                    //в итоге тернарный оператор будет иметь вид (location.search ? "&" : "?")
                    var newURL = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;

                    // Возможна ситуация когда у нас может при манипуляциях с url появиться дублирующий амперсанд, поэтому заменяем его на одиночный
                    newURL = newURL.replace('&&', '&');
                    // А так же возможна ситуация когда у нас может при манипуляциях с url появиться вопрос и амперсанд, поэтому заменяем его на одиночный вопрос
                    newURL = newURL.replace('?&', '?');

                    // Метод pushState объекта history обновляет состояние url добавляя (или заменяя) его тем что храниться в newURL
                    history.pushState({}, '', newURL);
                });
            },
            error: function () {
                alert('Ошибка!');
            }
        });
    }else{
        window.location = location.pathname;
    }
});

/* Search */
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
        // hint: false,
        highlight: true
    }, {
        name: 'products',
        display: 'title',
        limit: 10, // Количество отбираемых элементов для поиска. Должно быть на 1 меньше чем в запросе отборки
        source: products
    });

$('#typeahead').bind('typeahead:select', function (ev, suggestion) {
    // console.log(suggestion);
    window.location = path + '/search/?find=' + encodeURIComponent(suggestion.title);
});
/* End Search */

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
        data: {id: id, qty: quantity, mod: modification},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка. Попробуйте позже!');
        }
    });
});

$('#cart .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});

function showCart(response) {
    if ($.trim(response) == '<h3>Корзина пуста</h3>') {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(response);
    $('#cart').modal();
    if ($('#cart .cart-sum').text()) {
        $('.simpleCart_total').html($('#cart .cart-sum').text());
    } else {
        $('.simpleCart_total').text('Корзина пуста');
    }

}

function getCart() {
// console.log('Показ корзины');
    $.ajax({
        url: path + '/cart/show',
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка. Попробуйте позже!');
        }
    });
}

function clearCart() {
    // console.log('Очистка всей корзины');
    $.ajax({
        url: path + '/cart/clear',
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка. Попробуйте позже!');
        }
    });
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