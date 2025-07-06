$(document).ready(function() {
    jQuery.validator.addMethod("phoneFormat", function() {
        var isSuccess = false;
        var shop_phone = $("input[name='shop_phone']").val();
        var letter = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        if ($.trim(shop_phone) == '' || shop_phone.match(letter)){
            isSuccess = true;
        }
        return isSuccess;
    }, 'Số điện thoại không hợp lệ');

    $("#f-register").validate({
        rules: {
            shop_name: {
                required: true
            },
            shop_phone: {
                phoneFormat: true
            }
        },
        messages: {
            shop_name: {
                required: 'Nhập tên cửa hàng'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});