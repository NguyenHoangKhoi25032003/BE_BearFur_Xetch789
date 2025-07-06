$(".block-banner--slider").slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    arrows: false,
    dots: true,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
            },
        },
    ],
});
$(".block-partner--slider").slick({
    infinite: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
    ],
});
$(".block-product--slider").slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});
$(".block-categories--slider").slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});
$(".block-post--slider").slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});
$(".single-product-image--slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: false,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
    ],
});
$(".block-relative--slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: false,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$(window).scroll(function() {
    if ($(window).scrollTop() > 250) {
        $(".box-scroll-top").addClass("show");
    } else $(".box-scroll-top").removeClass("show");
});
$(".box-scroll-top").click(function() {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
});
$(".block-list-categories--content > li:has(ul)").each(function() {
    $(this).children('.title').children('.plus--icon').css('display', 'block');
})
$(".block-list-categories--content .title").click(function() {
    if ($(this).hasClass("active")) {
        $(this).toggleClass("active");
    } else {
        $(".block-list-categories--content .title").removeClass("active");
        $(this).addClass("active");
    }
});
$(".single-product--form .btn--down").on("click", function() {
    $number = $(".single-product--form .input--qualities").val();
    if ($number > 1) {
        --$number;
    }
    $(".single-product--form .input--qualities").val($number);
});
$(".single-product--form .btn--up").on("click", function() {
    $number = $(".single-product--form .input--qualities").val();
    if ($number < 99) {
        ++$number;
    }
    $(".single-product--form .input--qualities").val($number);
});
$('.block-wapper-cart-table .minus-btn').on("click", function() {
    $id = $(this).attr("data-rowid");
    $val = $(`.block-wapper-cart-table .qty[data-rowid="${$id}"]`).val();
    if ($val > 1) {
        $val--;
    }
    $(`.block-wapper-cart-table .qty[data-rowid="${$id}"]`).val($val);
})
$('.block-wapper-cart-table .plus-btn').on("click", function() {
    $id = $(this).attr("data-rowid");
    $val = $(`.block-wapper-cart-table .qty[data-rowid="${$id}"]`).val();
    if ($val < 99) {
        $val++;
    }
    $(`.block-wapper-cart-table .qty[data-rowid="${$id}"]`).val($val);
})

function goToURLFilter(param, this_value) {
    var query_string_value = getQuerystring(param);
    var query_string_character = '?';

    if (document.location.search.length) {
        query_string_character = '&';
    }

    if (query_string_value === '') {
        window.location.href = document.URL + query_string_character + param + '=' + this_value;
    } else {
        window.location.href = updateQueryStringParameter(document.URL, param, this_value);
    }
}
$(document).on('click', '.btn-clear-all', function(event) {
    event.preventDefault();
    deleteQueryStringParameter('brands');
    deleteQueryStringParameter('price');
    window.location.href = document.URL;
});
$(document).on('click', '.btn-clear-filter', function(event) {
    event.preventDefault();
    $(this).remove();
    var this_value = [];
    var fieldter = $(".btn-fieldter");
    fieldter.each(function() {
        this_value.push($(this).attr('data-id'));
    });
    if (this_value.length) {
        goToURLFilter('brands', this_value);
    } else {
        deleteQueryStringParameter('brands');
        window.location.href = document.URL;
    }
});
$(document).on('click', '.check-filter', function() {
    var this_value = [];
    var check_filter = $("input:checkbox[class=check-filter]:checked");
    check_filter.each(function() {
        this_value.push($(this).val());
    });
    if (this_value.length) {
        goToURLFilter('brands', this_value);
    } else {
        deleteQueryStringParameter('brands');
        window.location.href = document.URL;
    }
});
$(document).on('click', '.check-filter-price', function() {
    var this_value = [];
    // var check_filter = $("input:checkbox[class=check-filter-price]:checked");
    // check_filter.each(function() {
    //     this_value.push($(this).val());
    // });
    if($(this).is(':checked')){
        this_value.push($(this).val());
    }
    if (this_value.length) {
        goToURLFilter('price', this_value);
    } else {
        deleteQueryStringParameter('price');
        window.location.href = document.URL;
    }
});