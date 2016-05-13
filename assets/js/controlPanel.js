/* فنكشن إعادة ضبط عناصر قائمة التحكم حسب الحجم يستدعى عند الإقلاع وعند تغيير أبعاد الشاشة */
function reset_size() {
    var w = parseInt($(window).width());
    if (w >= 768 && w <= 992)
        $(".rightMenuText,i.ti-angle-left.pull-left").hide();
    else
        $(".rightMenuText,i.ti-angle-left.pull-left").show();
}

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
    var navbarHeight   = $(".navbar-inverse").height(); // ارتفاع الشريط الأسود العلوي
    var documentHeight = $(document).height(); // ارتفاع كامل الصفحة
    var fullHeight     = parseInt(documentHeight) - parseInt(navbarHeight); // الفرق بين الارتفاعين

    /* تابع إعطاء ارتفاع 100% لمن يحمل كلاس fullHeight */
    function resetHeight() {
        $('.fullHeight').css("height", fullHeight);
    }

    resetHeight(); // تنفيذ التابع عن فتح لوحة التحكم
    $(window).resize(function () {
        resetHeight(); // تنفيذ ضبط ارتفاع كامل عند تغيير أبعاد المتصفح أو قلب الموبايل
    });


    /* طي القائمة إذا كان الحجم صغيراً */
    $(window).resize(function () {
        reset_size();
    });
    reset_size();


    /* خلفية غامقة لعنصر لوحة التحكم المفتوح عن طريق إضافة كلاس للعنصر الذي له نفس رابط الصفحة المفتوحة */
    $("#controlPanelMenu").find(".list-group-item").each(function () {
        var i;
        var cat = $(this).data("cat");
        if (cat) {
            var res = cat.split(",");
            for (i = 0; i < res.length; i++) {
                if (seg1 == res[i])
                    $(this).addClass("active1");
            }
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

    /* إضافة تصنيف */
    $("#fcModalBtn").click(function () {
        $("#fcModalTitle").html('<i class="glyphicon glyphicon-plus"></i> إضافة تصنيف جديد');
        $("#fcModal").modal();
        $("#fcModalContent").html(loadingBar).load(base_url + 'control/add_food_category_modal');
    });

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

    // ------------------------------------------
    /* المواد الغذائية */
    /* إضافة مادة */
    $("#fsModalBtn").click(function () {
        $("#fsModalTitle").html('<i class="glyphicon glyphicon-plus"></i> إضافة مادة غذائية جديدة');
        $("#fsModal").modal();
        $("#fsModalContent").html(loadingBar).load(base_url + 'control/add_food_stuff_modal');
    });
    /* حذف مادة غذائية */
    $('.deleteStuff').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).parent().parent().fadeOut();
        $.post(url);
    });
    // ------------------------------------------
    /* أقسام الموقع */

    /* إضافة قسم */
    $("#partModalBtn").click(function () {
        $("#partModalTitle").html('<i class="glyphicon glyphicon-plus"></i> إضافة قسم جديد');
        $("#partModal").modal();
        $("#partModalContent").html(loadingBar).load(base_url + 'control/add_part_modal');
    });

    /* حذف قسم */
    $('.deletePart').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).parent().parent().fadeOut();
        $.post(url);
    });

    /* تعديل قسم */
    $('.editPart').click(function () {
        var t     = $(this).data('title');
        var id    = $(this).data('id');
        var level = $(this).data('level');
        var img   = $(this).data('img');
        var desc  = $(this).data('desc');

        $("#partModalTitle").html('<i class="ti-pencil-alt"></i> تعديل قسم');
        $("#partModal").modal();
        $("#partModalContent").html(loadingBar).load(base_url + 'control/edit_part_modal', {
            title: t,
            id: id,
            level: level,
            img: img,
            desc: desc
        });

    });
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

    /* حذف مقال */
    $('.delete_post').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).parent().parent().fadeOut();
        $.post(url);
    });

    /* تعديل مقال */
    $(".edit_post").click(function (e) {
        e.preventDefault();
        var part_id = $(this).data('part_id');
        var title   = $(this).data('title');
        var id      = $(this).data('id');
        var tags    = $(this).data('tags');
        $("#post_title_edit").val(title);
        $('#post_tags_edit').tagsinput('add', tags);
        $('#post_part_edit').find('option[value="' + part_id + '"]').attr('selected', 'selected');

        $("#edit_post_form").find(".panel-body").html(loadingBar).load(base_url + 'control/get_post_by_id/' + id);
        $("#edit_post_form").attr("action", base_url + "control/update_post/" + id);

    });

    /* تعديل بيانات مستخدم */
    $("#save-loading").hide();
    $("#user_edit_form").ajaxForm({
        beforeSend: function (e) {
            $("#save-loading").show();
            $("#save-action").hide();
        },
        success: function () {
        },
        complete: function (response) {
            $("#save-loading").hide();
            $("#save-action").show();
        }
    });


    // ------------------------------------------
    /* التعليقات */

    /* زر حذف تعليق */
    $(".deleteComment").click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).closest("tr").fadeOut();
        $.post(url);
    });

    /* الموافقة على تعليق */
    $(".approveComment").click(function (e) {
        var new_comments = parseInt($("#new_comments").html());
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).toggleClass("btn-success");

        if ($(this).hasClass("btn-success"))
            $("#new_comments").html(new_comments - 1);
        else
            $("#new_comments").html(new_comments + 1);
        $.post(url);
    });
});
