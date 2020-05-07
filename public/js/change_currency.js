/**
 * Created by Дмитрий on 14.11.2018.
 */
$('#currency').change(function () {
    window.location = 'currency/change?curr='+ $(this).val();
});