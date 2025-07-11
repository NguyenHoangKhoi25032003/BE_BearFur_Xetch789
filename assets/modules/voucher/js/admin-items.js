//<![CDATA[
$(document).ready(function() {
    $('.delete_bootbox').on('click', function(e, confirmed) {
        var link = $(this).attr('href');
        if (!confirmed) {
            e.preventDefault();
            BootstrapDialog.confirm({
                title: 'XÁC NHẬN THÔNG TIN',
                message: 'Bạn có thật sự muốn xóa mã giảm giá này? Nếu đồng ý, tất cả dữ liệu liên quan sẽ bị xóa. Bạn sẽ không thể phục hồi lại chúng sau này!',
                type: BootstrapDialog.TYPE_DANGER,
                closable: true,
                draggable: true,
                btnCancelLabel: 'Hủy bỏ',
                btnOKLabel: 'Đồng ý',
                btnOKClass: 'btn-primary',
                callback: function(result) {
                    if (result) {
                        window.location.href = link;
                    }
                }
            });
        }
    });
    
    var obj_fields = {
        'status': {field: "status", massage_success: "Đã bật kích hoạt mã giảm giá!", massage_warning: "Đã tắt kích hoạt mã giảm giá!"}
    };
    Object.keys(obj_fields).forEach(function (key) {
        $(".change-" + key).on('ifChanged', function () {
            var id = $(this).val();
            var value = 0;
            var strURL = base_url + 'admin/voucher/change-field';
            if ($(this).is(':checked')) {
                value = 1;
            }
            var form_data = obj_fields[key];
            form_data.id = id;
            form_data.value = value;

            $.ajax({
                type: "POST",
                url: strURL,
                data: form_data,
                success: function (html) {
                    $("#notify").html(html);
                }
            });

            return false;
        });
    });
});
//]]>