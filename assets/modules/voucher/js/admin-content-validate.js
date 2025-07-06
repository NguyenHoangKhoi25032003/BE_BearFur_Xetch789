$(document).ready(function () {
	$('.mask-price').mask('000.000.000', {reverse: true});
	 
	jQuery.validator.addMethod("codeCheck", function () {
        var isSuccess = false;
        var coupon_code = $('#coupon_code').val();

        var id = 0;
        if ($('#id').length) {
            id = $('#id').val();
        }

        var strURL = base_url + 'admin/voucher/check-code-availablity-ajax';
        var data = {'coupon_code': coupon_code, 'id': id, 'ajax': 1};
        $.ajax({
            url: strURL,
            type: 'POST',
            async: false,
            data: data,
            success: function (response) {
				//console.log(response);
                var getData = $.parseJSON(response);
                if (getData.status === 'success') {
                    isSuccess = true;
                }
            }
        });

        return isSuccess;
    }, 'Mã giảm giá này đã sử dụng');
	
	$("#f-content").validate({
        rules: {
            coupon_code: {
                required: true,
                codeCheck: true
            },
            discount: {
                required: true
            }
        },
        messages: {
            coupon_code: {
                required: 'Nhập mã giảm giá'
            },
            discount: {
                required: 'Nhập giảm giá'
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});

$(document).on('click', "#btn-generate-coupon", function(e) {
	var no_of_coupons = 1;//$('input[name="no_of_coupons"]').val();
	var length = $('input[name="length"]').val();
	var prefix = $('input[name="prefix"]').val();
	var suffix = $('input[name="suffix"]').val();
	var numbers = $('select[name="numbers"]').val();
	var letters = $('select[name="letters"]').val();
	var symbols = $('select[name="symbols"]').val();
	var random_register = $('select[name="random_register"]').val();
	var mask = $('input[name="mask"]').val();
	
	var form_data = {
		no_of_coupons: no_of_coupons,
		length: length,
		prefix: prefix,
		suffix: suffix,
		numbers: numbers,
		letters: letters,
		symbols: symbols,
		random_register: random_register,
		mask: mask
	};
	$.ajax({
		url: base_url + 'admin/voucher/get-generate-coupons-ajax',
		data: form_data,
		type: 'POST',
		dataType: 'json',
		success: function (response) {
			console.log(response);
			if(response.status == 'success'){
				$('#coupon_code').val(response.content);
				$("#processing-modal").modal("hide");
			}
		},
		error: function (e) {
			console.log('Errors: ' + e.responseText);
		}
	});
	return false;
});

$(document).on('click', ".btn-generate-coupon", function(e) {
	$("#processing-modal").modal("show");
});