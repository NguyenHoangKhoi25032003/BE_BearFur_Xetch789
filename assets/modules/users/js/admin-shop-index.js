$(document).ready(function() {
    $('.confirm_bootstrap').on('click', function(e, confirmed) {
        var link = $(this).attr('href');
        if (!confirmed) {
            e.preventDefault();
            BootstrapDialog.confirm({
                title: 'XÁC NHẬN THÔNG TIN',
                message: 'Bạn có thật sự muốn xóa cửa hàng này? Nếu đồng ý, tất cả dữ liệu liên quan sẽ bị xóa. Bạn sẽ không thể phục hồi lại chúng sau này!',
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
});

$(document).on('click', '.shop-status', function (event) {
    var $this = $(this).closest('.shop-status-container');
    var id = parseInt($this.attr('data-id'));
    if(id == 0){
        return false;
    }
    var status = parseInt($(this).attr('data-status'));
    var status_text = $(this).text();
    var data = {
        'id': id,
        'status': status
    };
    // console.log(data); return false;
    $('#notify').html('Đang xử lý...').fadeIn(5000);
    $.ajax({
        url: base_url + 'admin/users/change-shop-status-ajax',
        data: data,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            $("#notify").html(response.message);
            if (response.status === 'success') {
                var content = response.content;
                var el_button = $this.find('button');
                el_button.removeClass("btn-success btn-danger btn-default btn-warning").addClass("btn-" + content.status_label);
                el_button.first().text(content.status_text);
                $this.find('.dropdown-menu').html(content.status_action);
                $this.trigger('click');
            }
        },
        error: function(e) {
            console.log('Error processing your request: ' + e.responseText);
        }
    });
    return false;
});