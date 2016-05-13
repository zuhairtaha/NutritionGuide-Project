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
    // ------------------------------------------
    /* المستخدمين */


    /* إعادة ضبط كلمة المرور بالأجاكس */
    $("#restPassForm").ajaxForm({
        beforeSend: function (e) {
            $("#notes").html(loadingBar);
        },
        success: function () {
        },
        complete: function (response) {
            var r = response.responseText;
            $("#notes").html(r);
        }
    });

    /* التحقق من ملئ كافة الحقول في فورم التسجيل قبل إرساله */
    $("#register_form").submit(function (e) {
        var err       = "";
        var user_name = $("#user_name").val();
        if (!user_name) err += "لم تدخل اسم المستخدم <br />";
        var user_email = $("#user_email").val();
        if (!user_email) err += "لم تدخل بريدك الإلكتروني <br />";
        var user_password = $("#user_password").val();
        if (!user_password) err += "لم تدخل كلمة المرور <br />";
        var user_birthDate = $("#user_birthDate").val();
        if (!user_birthDate) err += "لم تدخل تاريخ ميلادك <br />";

        if (err != "") {
            e.preventDefault();
            $("#errors_p").show().html(err);
        }
    });

    /* إظهار مودال تسجيل الدخول */
    $("#user-login-anchor").click(function (e) {
        e.preventDefault();
        $("#login_modal").modal();
    });
    /* ------------------------------------------*/
    /* فورم تسجيل الدخول */

    $("#login_form").ajaxForm({
        beforeSend: function (e) {
            $("#login_info").html(loadingBar);
        },
        success: function () {
        },
        complete: function (response) {
            var r = response.responseText;
            if (r == "true") {
                var current_url      = window.location.href;
                window.location.href = current_url;
                r                    = "أهلاً وسهلاً بك";
            }
            $("#login_info").html(r);
        }
    });

    /* فورم إضافة تعليق : أجاكس */

    $("#add_comment_form").ajaxForm({

        beforeSend: function (e) {
            var user_name       = $("#comment_user_name").val();
            var now_date        = $.now();
            var comment_content = $("#comment_content").val();
            var comment         = '<div class="media margin-bottom-1">\
                <div class="media-left">\
            <div class="comment_user_photo"><i class="fa fa-user"></i></div>\
                </div>\
                <div class="media-body">\
                <h4 class="media-heading">\
            <b>' + user_name + '</b>\
            </h4>\
            ' + comment_content + '\
            <p class="gray_color">\
                <i class="fa fa-clock-o"></i>\
                <time class="timeago" datetime="' + now_date + '"></time>\
            </p>\
            </div>\
            </div>';
            $("#comments").append(comment);
        },
        success: function () {
        },
        complete: function (response) {
        }
    });

    /* إضافة كلاس التنشيط على العنصر الذي يملك نفس رابط الصفحة الحالية */
    $(".navbar  a").each(function () {
        var current_hre = $(this).attr("href");
        var current_url = window.location.href;
        if (current_hre == current_url) {
            $(this).parent("li").addClass("active");
        }
    });

    /* تثبيت الشريط الأسود عند الوصول إليه */
    var black_nav_offset = $('#black_nav').offset().top;
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > black_nav_offset) {
            $('#black_nav').addClass('navbar-fixed-top container');
        }
        else {
            black_nav_offset = $('#blackNav_row').offset().top;
            $('#black_nav').removeClass('navbar-fixed-top container');
        }
    });

    /* تقليب تلقائي في السلايد شو بالضط على زر النقل كل فترة زمنية */
    setInterval(function () {
        $(".nav-arrow-next").click();
    }, 3000);
    /* ------------------------------------------*/

    /* حساب الوضع الصحي */
    $("#MBI_form").submit(function (e) {
        e.preventDefault();
        var age    = $("#age").val();
        var height = $("#height").val();
        height     = height / 100;
        var gender = $("#gender").val();
        var mass   = $("#mass").val();
        var mbi    = Math.round(mass / (height * height));
        $('#mbiSpan').html("مؤشر كتلة الجسم لديك هو " + mbi);
        var r      = "";
        var imgSrc = "";
        if (mbi > 40) {
            r      = "انت بدين بدانة مفرطة, من الأفضل زيارة الطبيب!!";
            imgSrc = "s1";
        }
        else if (mbi > 30 && mbi <= 40) {
            r      = "أنت تعاني من البدانة, تريد بعض شفط الدهون?";
            imgSrc = "s2";
        }
        else if (mbi > 27 && mbi <= 30) {
            r      = "أنت سمين جدا, أخسر وزنك قبل فوات الاوان";
            imgSrc = "s3";
        }
        else if (mbi > 22 && mbi <= 27) {
            r      = "أنت سمين بعض الشيء, تحتاج اتباع نظام غذائي وممارسة التمارين الرياضية";
            imgSrc = "s4";
        }
        else if (mbi >= 21 && mbi <= 22) {
            r      = "أنا أحسدك وزنك مثالي, حافظ عليه!";
            imgSrc = "s5";
        }
        else if (mbi >= 18 && mbi < 21) {
            r      = "أنت نحيف, كل المزيد.";
            imgSrc = "s6";
        }
        else if (mbi >= 16 && mbi < 18) {
            r      = "أنت تعاني من النحافة بعض الشيء, إذهب وتناول بعض المواد الغذائية!";
            imgSrc = "s7";
        }
        else if (mbi < 16) {
            r      = "أنك تعاني من النحافة إلى حد كبير, تحتاج دخول المستشفى ";
            imgSrc = "s8";
        }
        $("#mbi_result").html(r);
        $("#img_status").show().attr("src", base_url + "assets/img/bmi/" + imgSrc + ".jpg");

    });

    /* ---------------------- end --------------------------- */

});


