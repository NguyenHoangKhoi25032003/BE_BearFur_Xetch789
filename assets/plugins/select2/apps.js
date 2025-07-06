var elProducts = "#products-id";

function selectAll() {
    $(elProducts + " > option").prop("selected", true);
    $(elProducts).trigger("change");
}

function deselectAll() {
    $(elProducts + " > option").prop("selected", false);
    $(elProducts).trigger("change");
}

$(document).ready(function() {
    $(elProducts).select2({
        placeholder: 'Nhập tên hoặc mã sản phẩm...',
        multiple: true,
        allowClear: true,
        language: "vi",
        ajax: {
            url: base_url + "products/search-ajax",
            type: "POST",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        },
        data: initialPropertyOptions
    });
});

$(document).on('click', '.btn-select-all', function(){
	$.ajax({
	    url: base_url + "products/search-ajax",
        type: "POST",
        dataType: "json",
        data: {
            q: ''
        },
	}).then(function (data) {
		// console.log(data);
		$(elProducts).empty();
	    data.forEach(function(d) {
            var option = new Option(d.text, d.id, true, true);
            $(elProducts).append(option).trigger('change');
        });
	});
});