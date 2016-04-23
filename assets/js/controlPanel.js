$(function () { // when document is ready
    // ------------------------------------------
    /* متغيرات عامة */

    /* شريط متحرك أثناء التحميل بالأجاكس يستخدم في عدة مناطق من الموقع */
    var loadingBar = '<div class="progress left">\
    <div class="progress-bar progress-bar-striped active" \
    role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\
    </div></div> ';
// ------------------------------------------
    /* ما يتعلق بالقالب */

    /* ضبط ارتفاع القائمة اليمنى مائة بالمائة */
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
        resetHeight();
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

        }
    });
// ------------------------------------------
    /* الصفحات */

    /* حذف صفحة */
    $('.deletePage').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).parent().parent().fadeOut();
        $.post(url);
    });

    /* تعديل صفحة */
    $('.editPages').click(function () {
        var t     = $(this).data('title');
        var id    = $(this).data('id');
        var level = $(this).data('level');
        $("#PageTitleEdit").val(t);
        $("#PagesIdEdit").val(id);
        $("#PageLevel").val(level);
        var url  = base_url + "control/getPageBody/" + id;
        var url2 = base_url + "control/updatePage/" + id;
        $(".editPagesDivModal .panel-body").html(loadingBar).load(base_url + 'control/getPageBody/' + id);
        $("#editPagesForm").attr("action", url2);

    });

    // ------------------------------------------
    /* تصنيفات الأغذية */

    /* حذف تصنيف */
    $('.deleteCategory').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).parent().parent().fadeOut();
        $.post(url);
    });

    /* تعديل تصنيف */
    $('.editCategories').click(function () {
        var t     = $(this).data('title');
        var id    = $(this).data('id');
        var level = $(this).data('level');
        var img   = $(this).data('img');

        $("#fcModalTitle").html('<i class="ti-pencil-alt"></i> تعديل تصنيف');
        $("#fcModal").modal();
        $("#fcModalContent").html(loadingBar).load(base_url + 'control/edit_food_category_modal', {
            title: t,
            id: id,
            level: level,
            img: img
        });

    });

    /* فتح المودال عند الضغط على زر أضف تصنيف جديد */
    $("#fcModalBtn").click(function () {
        $("#fcModalTitle").html('<i class="glyphicon glyphicon-plus"></i> إضافة تصنيف جديد');
        $("#fcModal").modal();
        $("#fcModalContent").html(loadingBar).load(base_url + 'control/add_food_category_modal');
    });


    // ------------------------------------------


});