$(function () { // when document is ready
    // ------------------------------------------
// ضبط ارتفاع القائمة اليمنى مائة بالمائة
    var navbarHeight = $(".navbar-inverse").height(); // ارتفاع الشريط الأسود العلوي
    var documentHeight = $(document).height(); // ارتفاع كامل الصفحة
    var fullHeight = parseInt(documentHeight) - parseInt(navbarHeight); // الفرق بين الارتفاعين

    /* تابع إعطاء ارتفاع 100% لمن يحمل كلاس fullHeight */
    function resetHeight() {
        $('.fullHeight').css("height", fullHeight);
    }

    resetHeight(); // تنفيذ التابع عن فتح لوحة التحكم
    $(window).resize(function () {
        resetHeight(); // تنفيذ ضبط ارتفاع كامل عند تغيير أبعاد المتصفح أو قلب الموبايل
    });

    /* عند الضغط على زر طي القائمة */
    $("#collapseMenu").click(function () {
        $("#controlPanelMenu").toggleClass("col-md-2 col-md-1").toggleClass("bigIcons");
        $("#controlPanelContent").toggleClass("col-md-10 col-md-11");
        $(window).resize();
    });

    /* طي القائمة إذا كان الحجم صغيراً */
    $(window).resize(function () {
        var w = parseInt($(window).width());
        if (w < 767) $("#collapseMenu").click();
    });

    /* خلفية غامقة لعنصر لوحة التحكم المفتوح عن طريق إضافة كلاس للعنصر الذي له نفس رابط الصفحة المفتوحة */
    $("#controlPanelMenu").find(".list-group-item").each(function () {
        var cat = $(this).data("cat");
        if (seg1 == cat) {
            $(this).addClass("active1");
            console.log(cat + "," + seg1);
        }
    });

    // ------------------------------------------

});