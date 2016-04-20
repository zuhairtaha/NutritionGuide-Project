$(function () { // when document is ready
    // ------------------------------------------
// ضبط ارتفاع القائمة اليمنى مائة بالمائة
    var navbarHeight   = $(".navbar-inverse").height();
    var documentHeight = $(document).height();
    var fullHeight     = parseInt(documentHeight) - parseInt(navbarHeight);

    function resetHeight() {
        $('.fullHeight').css("height", fullHeight);
    }

    resetHeight();
    $(window).resize(function () {
        resetHeight();
    });
    $("#collapseMenu").click(function () {
        $("#controlPanelMenu").toggleClass("col-md-2 col-md-1").toggleClass("bigIcons");
        $("#controlPanelContent").toggleClass("col-md-10 col-md-11");
        $(window).resize();

    });
// detect what size is
    $(window).resize(function () {
        var w = parseInt($(window).width());
        if (w < 767) $("#collapseMenu").click();

    });
//
    $(".cPanelMenuAnchor").each(function () {
        var cat = $(this).data("data-cat");
        if (seg1 == cat) $(this).addClass("active1");
        console.log(cat+","+seg1);
    });

    // ------------------------------------------

});