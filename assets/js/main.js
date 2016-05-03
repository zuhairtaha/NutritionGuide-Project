var loadingBar     = '<div class="progress left"> <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"> </div></div> ';
var search_section = "posts";

$(document).ready(function () {
    /* -------------------- start ---------------------------- */

    /* الشريط المتحرك الأفقي لعرض التصنيفات الغذائية */
    $("#horizontal_food_categories").slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 5,
        rtl: true,
        autoplay: true,
        arrows: true,

        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });


    /* اخر المستجدات */

    $(".last_news_tabs").find("li").click(function (e) {
        e.preventDefault();
        $(".last_news_tabs li").removeClass('active');
        $(this).addClass("active");
        $(".last_ul_list").removeClass("hide").hide();
        var a = $(this).data('target');
        $("#" + a).show();
    });
    // ------------------------------------------

    /* توحيد طول حاويات الأقسام */
    var max_length    = 0;
    var part_view_div = $(".part_view_div");
    part_view_div.each(function () {
        if ($(this).height() > max_length) max_length = $(this).height();
    });

    part_view_div.height(parseInt(max_length));

    // ------------------------------------------
    /* البحث */

    /* تحريض مودال البحث */
    $("#search_modal_btn").click(function () {
        $("#search_modal").modal();
    });

    /* مكان البحث */
    $("#search_section_ul").find("li").click(function () {
        search_section = $(this).data("search_section");
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
    });

    /* عند الضغط على زر بحث: تحميل نتائج البحث بالأجاكس */
    $("#action_search").click(function (e) {
        e.preventDefault();
        var key                = $("#key_search").val();
        var section            = $("#search_section_ul").find("li.active").attr("value");
        var search_results_div = $("#search_results_div");
        key                    = key.replace("'", "");
        key                    = key.replace(/\s{2,}/g, ' ');
        key                    = $.trim(key);
        if (!key) {
            search_results_div.html("يرجى إدخال نص البحث أولاً");
            return;
        }
        search_results_div.html(loadingBar).load(base_url + "search", {
            section: section,
            key: key
        });
        $("#searchModalTitle").html('<i class="glyphicon glyphicon-search"></i> نتائج البحث عن : ' + key);
    });

    /* عند ضغط انتر في حقل البحث النصي */
    $('#key_search').keyup(function (e) {
        if (e.keyCode == 13) {
            $("#action_search").click();
        }
    });

    /* ---------------------- end --------------------------- */

});


