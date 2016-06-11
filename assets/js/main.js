/* تمديد مكتبة jQuery بتابع الحركة. المصدر: https://github.com/daneden/animate.css  */
// usage:  $("#selector").animateCss("swing");

var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
$.fn.extend({
    animateCss: function (animationName) {
        $(this).addClass('animated ' + animationName).one(animationEnd, function () {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
// ------------------------------------------

/* رابط الصفحة الحالية */
var current_url = window.location.href;
// ------------------------------------------

/* فحص عنصر إن كان موجود أم لا */
function checkDom(dom) {
    return !!(typeof(dom) != 'undefined' && dom != null);
}
// ------------------------------------------
/* مودال جاري التعديل */
// pleaseWaitDiv.modal();    pleaseWaitDiv.modal('hide');
var pleaseWaitDiv = $('\
<div class="modal fade loadingBox" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">\
    <div class="modal-dialog modal-sm">\
        <div class="modal-content">\
            <div class="modal-header">\
            <h4 id="mySmallModalLabel" class="modal-title center">جاري التعديل</h4>\
            </div>\
            <div class="modal-body">\
                <div class="progress left">\
                    <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\
                    </div>\
                </div> \
            </div>\
        </div>\
    </div>\
</div>\
');

// ------------------------------------------

/* تنبيه إن كان المتصفح لا يدعم html5 */
var test_canvas = document.createElement("canvas"); //try and create sample canvas element
var canvasback  = (test_canvas.getContext) ? true : false; //check if object supports getContext() method, a method of the canvas element
if (!canvasback) alert('يرجى تحديث متصفح الانترنت لديك لآخر إصدار لأنه لايدعم HTML5'); //alerts true if browser supports canvas element
// ------------------------------------------

var loadingBar     = '<div class="progress left"> <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"> </div></div> ';
var search_section = "posts";

$(document).ready(function () {
    /* -------------------- start document.ready---------------------------- */
    $('.tooltip1').tooltip();
    $('[title]').tooltip();

    // ------------------------------------------

    /* الشريط المتحرك الأفقي لعرض التصنيفات الغذائية */
    if (base_url == current_url) {
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
    }

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
        var user_name = $("#user_name", this).val();
        if (!user_name) err += "لم تدخل اسم المستخدم <br />";
        var user_email = $("#user_email", this).val();
        if (!user_email) err += "لم تدخل بريدك الإلكتروني <br />";
        var user_password = $("#user_password", this).val();
        if (!user_password) err += "لم تدخل كلمة المرور <br />";
        var user_birthDate = $("#user_birthDate", this).val();
        if (!user_birthDate) err += "لم تدخل تاريخ ميلادك <br />";
        else {
            var y = parseInt(/\d{4}/.exec(user_birthDate)[0]);
            if (y < 1916 || y > 2001)err += "تاريخ الميلاد يبدو غير صالح <br />";
        }

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
                <i class="fa fa-hourglass-half" aria-hidden="true"></i> سيتم إضافة التعليق بعد موافقة الإدارة\
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

    /* إظهار الأقسام */
    $("#categories_row").show();

    /* textarea يكبر ويصغر حسب عدد الأسطر */
    $(".auto_grow").autogrow();

    // ------------------------------------------

    /* إرسال إيميل : أجاكس */
    $(".sendMailForm").ajaxForm({
        beforeSend: function () {
            $('.mailingBox').modal();
            $("#resultHere2").html(loadingBar);
        },
        success: function () {
            // -----
        },
        complete: function (response) {
            var r = response.responseText;
            $("#mySmallModalLabel2").html(" إرسال رسالة ");
            $("#resultHere2").html(r);
        }
    });
    // ------------------------------------------
    // long shadow ظل أيقونات طويل
    $('[data-shadow]').each(function (i, value) {
        var t     = $(this).data('shadow');
        var n, sh = "", long1 = 150;
        for (n = 1; n <= long1; n++) {
            sh = sh + n + "px " + n + "px " + t;
            if (n != long1) sh = sh + ", ";
        }
        $(this).css("text-shadow", sh);
        $(this).css("position", "static");
    });
    // ------------------------------------------

    /* لمنع رفع أكثر من صورة للتصنيفات الأغذاية عن طريق إخفاء الزر إذا كانت هناك صورة مرفوعة */
    function allowUploadOneImage() {
        if ($("#imagesUpNames").val()) {
            $(".uploadImgs").hide();
        }
        else $(".uploadImgs").show();
    }

    function allowUploadOneImageEdt() {
        if ($("#imagesUpNamesEdt").val()) {
            $("#postEditContnt").find("#imagesUpNamesEdt").hide();
        }
        else  $("#postEditContnt").find("#imagesUpNamesEdt").show();
    }

// ------------------------------------------
    // floating button (header) زر عائم (لم يضف بعد)
    $('#floating-div').bind("mouseenter click", function () {
        $(".floating-blue").fadeIn("fast", function () {
            $(".floating-green").fadeIn();
        });
    }).bind("mouseleave", function () {
        $(".floating-green").fadeOut("fast", function () {
            $(".floating-blue").fadeOut();
        });
    });
    // ------------------------------------------

    /* لتصبح مقاطع الفيديو بأبعاد تجاوبية */
    $('iframe').wrap('<div class="embed-responsive embed-responsive-16by9">');
    // ------------------------------------------

    /* عند مررو الماوس على صورة اللوغو */
    $("#logo_img").hover(function () {
        $(this).animateCss("flipInX");
    }).animateCss("bounceInLeft");

    /* لملئ حقل الكلمات الدلالية تلقائياً من العنوان */
    if (checkDom($("#post_title"))) {
        $("#post_title").keyup(function () {
            var title = $(this).val();
            console.log(title);
            var keys = title.replace(/\s/g, ', ');
            $('#post_tags').tagsinput('removeAll');
            $('#post_tags').tagsinput('add', keys);
        });
    }
    // ------------------------------------------
    /* المقالات */
    /* إضافة مقال */
    $('#add_post_form').submit(function (e) {
        var title   = $('#post_title').val();
        var part    = $('#post_part').val();
        var content = $("#post_content").val();
        var tags    = $("#post_tags").val();
        var err     = '';

        if (!title) err += "لايوجد عنوان ";
        if (!content) err += "لايوجد محتوى";
        if (!tags) err += "لم تضف الكلمات الدلالية";
        if (!part) err += "لم تختر القسم المناسب";
        if (err) {
            e.preventDefault();
            alert(err);
        }
    });
    /* ---------------------- end --------------------------- */

});


