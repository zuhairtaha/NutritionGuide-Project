var delMySelf;
$(function () {
    $('.tooltip1').tooltip();
    $('[title]').tooltip();
    function anim(el, x) {
        $(el).addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass(x + ' animated');
            $(this).fadeOut();
        });
    }

    function anim2(el, x) {
        $(el).addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass(x + ' animated');
        });
    }

    function anim3(el, x, y) {
        $(el).addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass(x + ' animated');
            $(this).hide();
            $(y).show();
        });
    }

    function removeNumber(str, num) {
        var reg = new RegExp('(?:\\D+|^)' + num + '(?=\\D|$)');
        return str.replace(reg, '').replace(/^\D*/, '');
    }

// del uploaded file:
    function delFile(id) {
        var i = id;
        $(".liFile#" + id).fadeOut();
        $.get(base_url + 'welcome/delFile/' + id);
        var upUrls = $("#upUrls").val();
        upUrls     = removeNumber(upUrls, i);
        $("#upUrls").val(upUrls);

    }

    delMySelf = function () {
        $("#imagesUpNames").val("");
        anim($("#uploadedImagesRow.row").find("div.col-sm-6.col-md-4"), 'rubberBand');
        /*
         var imagesUpNames = $("#imagesUpNames");
         var str           = imagesUpNames.val();
         var imgSrc        = $(this).data("img");
         var res           = str.replace(imgSrc, "");
         res               = res.replace(",,", ",");
         res               = res.replace(/(^,)|(,$)/gi, "");
         console.log(res);
         imagesUpNames.val(res);
         */
        allowUploadOneImage();
    };

    $('a.btn-info').tooltip();
    $('.underM').popover({
        html: 'true',
        container: 'body',
        toggle: 'popover',
        placement: 'bottom'
    });

// upload : 

    function checkDom(dom) {
        if (typeof(dom) != 'undefined' && dom != null)
            return true;
        else
            return false;
    }

// ----------- alert if not support HTML5
    var test_canvas = document.createElement("canvas"); //try and create sample canvas element
    var canvasback = (test_canvas.getContext) ? true : false; //check if object supports getContext() method, a method of the canvas element
    if (!canvasback) alert('يرجى تحديث متصفح الانترنت لديك لآخر إصدار لأنه لايدعم HTML5'); //alerts true if browser supports canvas element
// ----------- /alert if not support HTML5        

// ----- /upload   
    $(document).ready(function () { // document ready start
        if (checkDom($("#part_id_copy"))) {
            var partId = $("#part_id_copy").val();
            if (partId == 24 || partId == 25 || partId == 27) {
            }
        }

// ------ /end update mark ------

// upload ajax
        var options = {
            beforeSend: function () {
                $("#progress").show();
                //clear everything
                $("#bar").width('0%');
                $("#message").html("");
                $("#percent").html("0%");
            },
            uploadProgress: function (event, position, total, percentComplete) {
                $("#bar").width(percentComplete + '%');
                $("#percent").html(percentComplete + '%');
            },
            success: function () {
                $("#bar").width('100%');
                $("#percent").html('100%');
            },
            complete: function (response) {
                $("#message").html("<p style='color:green'>" + response.responseText + "</p>");
            },
            error: function () {
                $("#message").html("<p style='color:red'> خطأ: لم يتم رفع الملف</p>");
            }
        };
        $("#myForm").ajaxForm(options);

// -------- /end upload ajax

// ------ weather append
        $("#weather").html('<h1><i class="glyphicon glyphicon-refresh spinner"></i></h1>').load(base_url + 'welcome/weather');
// ------/end weather append
        anim2($(".jumbotronHeader"), 'zoomInLeft');
        $('#mainPartSlct').change();
        $('#countrySelect').change();
        $(".uploadImgs").html('<h1><i class="glyphicon glyphicon-refresh spinner"></i></h1>').load(base_url + 'upload/up1');

    }); // ------------------------------ end ready
// ----------------- slider

    $(".bs-example-modal-lg").modal();
    $("textarea").autogrow();
////////////
    var myApp;
    myApp = myApp || (function () {
            return {
                showPleaseWait: function () {
                    $('.loadingBox').modal({keyboard: false});
                },
                hidePleaseWait: function () {
                    $('.loadingBox').modal('hide');
                }
            };
        })();

// ------------------------------------------
    var addSlideOptions = {
        beforeSend: function () {
            myApp.showPleaseWait();
        },
        success: function () {
            myApp.hidePleaseWait();
        },
        complete: function (response) {
            var Cid = response.responseText;

            $('.slides').append("<div class=\"col-sm-4 col-md-4\" id=\"s" + Cid + "\">\
                        <div class=\"thumbnail\">\
                        <img src=\"" + $('#imageForSlider').val() + "\" alt=\"\" />\
                        <div class=\"caption\">\
                        <p style=\"background:rgba(0,0,0,0.1);color:" + $('#textOnSlide_en').val() + "\">" + $('#textOnSlide_ar').val() + "</p>\
                        <p> <span href=\"#\" id=\"" + Cid + "\" class=\"btn btn-danger deSlideBtn\" role=\"button\">\
                        <i class=\"glyphicon glyphicon-trash\"></i> حذف</span></p>\
                        </div></div></div>");
            $("html, body").animate({scrollTop: $(document).height()}, 0);
        }
    };
    $("#addToSlideShow").ajaxForm(addSlideOptions);
// ------------------------------------------
    var upPointsVar = {
        beforeSend: function () {
            $("#updatePointsIcon").removeClass().addClass('fa fa-refresh fa-spin');
        },
        success: function () {
        },
        complete: function (response) {
            $("#updatePointsIcon").removeClass().addClass('fa fa-floppy-o');
        }
    };
    $("#updatePoints").ajaxForm(upPointsVar);
// ------------------------------------------
    $(".slides").on("click", ".deSlideBtn", function () {
// $(".deSlideBtn").click(function() {
        var id = $(this).attr('id');
        $.get(base_url + "control/delSlide/" + id);
        var t = document.getElementById("s" + id);
        anim(t, 'rubberBand');
    });
    $(".AddSlideBtn").tooltip().click(function () {
        var addSlideDiv = $(".addSlideDiv");
        addSlideDiv.removeClass("hide");
        $("html, body").animate({scrollTop: $(document).height()}, 0);
        anim2(addSlideDiv, 'zoomInLeft');
        $(this).hide();
        $(".hrBeforeAdd").hide();
    });
    $("#upModalBtn").click(function () {
        $("#add_images").click();
    });

    $(".logo").hover(function () {
        anim2($(this), 'flash');
    });
// end sider;
// ------------ add part

    $('.defHide#subPartsSelect').hide();
    $("input[type=radio]").on("click", function () {

        var r = $("input[type=radio]:checked").val();
        if (r == 'main') {
            $('#subPartsSelect').hide();
            var iconInputGroup = $('#iconInputGroup');
            iconInputGroup.show();
            anim2(iconInputGroup, 'fadeInLeft');
        }
        if (r == 'sub') {
            $('#iconInputGroup').hide();
            $('#subPartsSelect').show();
            anim2($('#subPartsSelect'), 'fadeInLeft');
        }
    });

    $('#iconInput').on("keyup", function () {
        var i = $(this).val();
        $('#iconHere').html('<i class="' + i + '"></i>');
    });

    $('.delPartBtn').on("click", function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var h    = href.match(/\d+/g)[1]; // for localhost put 1 insted of 0
        console.log(h);
        anim($('tr#t' + h), 'shake');
        $.get(href);
    });

    $('.delFavEl').on("click", function (e) {
        e.preventDefault();
        $(this).parent("p").fadeOut();
        $.post($(this).attr('href'));
    });

    $('.sbuttons a').on("click", function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        if (href != "#")
            $(this).children(".badge1").html('<i class="glyphicon glyphicon-refresh spinner"></i>').load(href);
    });

    $('#like').click(function () {
        $(this).toggleClass("btn-primary");
    });
    $('#Dlik').click(function () {
        $(this).toggleClass("btn-danger");
    });
    $('#fav').click(function () {
        $(this).toggleClass("btn-warning");
    });
// $('#tell').click(function(){ $(this).toggleClass("btn-info"); }); 

    var loadingBar = '<div class="progress left">\
    <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\
    </div>\
    </div> ';
    $('#addPartSubmitBtn').click(function () {
        $('#addPostForm').hide();
        $('.modalAddPart .modal-body').append(loadingBar);
    });

    $('.editPart').on("click", function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        $(".parts").html(loadingBar).load(href);
    });

    $(".partIconDiv").mouseenter(function () {
        anim2($(this), 'pulse');
    });

    $(".advImg").mouseenter(function () {
        anim2($(this), 'bounceIn');
    });

    $('#submitOptions').click(function () {
        $('form').submit();
    });

// ------------------- upload
    function sh() {
        document.getElementById("upload").style.display     = "block";
        document.getElementById("add_images").style.display = "none";
        $("#up_form").html('<h1><i class="glyphicon glyphicon-refresh spinner"></i></h1>').load(base_url + 'upload/up1');
    }

// ------------------------------------------

    $("#addCarTypeForm").ajaxForm({
        // https://www.youtube.com/watch?v=j-S5MBs4y0Q
        dataType: 'json',
        beforeSend: function () {
            $("#addCarTypeForm").hide();
            $("#modalBodyAddCarTypeForm").append(loadingBar);
        },
        success: function (r) {
            // $("#countrySelect option:last").after($('<option value="'+r.car_id+'">'+r.car_type+'</option>'));
            // add option to select and select id (no jQuery)
            countrySelect.add(new Option(r.car_type, r.car_id, true));
            $("#countrySelect").change();
        },
        complete: function () {
            $("#modalBodyAddCarTypeForm .progress").hide();
            $("#addCarTypeForm").show();
            $('#myModal5').modal('hide');

        }
    });

// ------------------------------------------

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
// ------------------------------------------ fields control tab
    $('.InputsControlDiv').show();
    $('.MenueControlDiv').hide();

    $('#inputsCntrlBtn').click(function () {
        $(this).addClass("active");
        $("#menueCtrlBtn").removeClass("active");
        $('.InputsControlDiv').show();
        $('.MenueControlDiv').hide();

    });
    $("#menueCtrlBtn").click(function () {
        $(this).addClass("active");
        $("#inputsCntrlBtn").removeClass("active");
        $('.InputsControlDiv').hide();
        $('.MenueControlDiv').show();
    });

// ------------------------------------------ about us admin

    $('#editorEnDiv').hide();
    $("#arabicBtnAbout").click(function () {
        $(this).addClass("active");
        $("#EngBtnAbout").removeClass("active");
        anim3('#editorEnDiv', 'bounceInLeft', '#editorArDiv');
        /* $('#editorEnDiv').hide();*/
    });

    $("#EngBtnAbout").click(function () {
        $(this).addClass("active");
        $("#arabicBtnAbout").removeClass("active");
        anim3('#editorArDiv', 'bounceInLeft', '#editorEnDiv');
        // $('#editorArDiv').hide();
        // $('#editorEnDiv').show();
    });
    function reformatType(car_type) {
        var n = '';
        n     = car_type.replace(" ", "_");
        n     = n.replace("-", "_");
        n     = n.toLowerCase();
        return n;
    }

// ------------------------------------------ coutry list select (register)
    $("#countrySelect").on("change", function () {
        var v         = $('#countrySelect').val();
        var logoValue = $(this).find("option:selected").text();
        $("#car_logo").html(loadingBar).load(base_url + 'manage/logo/' + reformatType(logoValue));
        $('#countryFlag').removeAttr('class').addClass('flag ' + v);
        $('#model_id_to_add').val(v);
        // $("#editTypesBtn").attr("href",base_url+'manage/editTypes');
    });
// ------------------------------------------
// admin/posts/edit
    $(".editMenueSelect").on("change", function () {
        var v         = $(this).val();
        var res       = v.split("-");
        var newFormId = res[0];
        var menueId   = res[1];
        $.post(base_url + 'manage/updateMenus/' + menueId + '/' + newFormId);
    });
// ------------------------------------------
    $('#loginBtn').click(function (e) {
        e.preventDefault();
    });
    $('#loginBtnSubmit').click(function () {
        $('#loginForm').submit();
    });
// ------------------------------------------

    $("#editMemberForm").ajaxForm({
        beforeSend: function () {
            $('.editingBox').modal();
            $("#resultHere2").html(loadingBar);
        },
        success: function () {
            // -----
        },
        complete: function (response) {
            var r = response.responseText;
            $("#mySmallModalLabel2").html("تم");
            $("#resultHere2").html(r);
        }
    });
// ------------------------------------------
    $(".approveBtn").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("btn-success");
        $(this).parent().parent().toggleClass("NewAdvTr");
        var url = $(this).attr("href");
        $.post(url);
    });
// ------------------------------------------
    $('.deletePost').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $(this).parent().parent().fadeOut();
        $.post(url);
    });
// ------------------------------------------
    $('.distinctiveBtn').click(function (e) {
        e.preventDefault();
        $(this).toggleClass("btn-info");
        var url = $(this).attr("href");
        $.post(url);

    });
// ------------------------------------------

    $().ready(function () {
        $(".editField").click(function (e) {
            e.preventDefault();
            alert($(this).prevAll("input").val() + "  test");
        });
    });
// ------------------------------------------
    $('.countriesList').on('change', function () {
        $('#statesDiv').html('<h1><i class="glyphicon glyphicon-refresh spinner"></i></h1>').load(base_url + "control/states/" + this.value);
    });
// ------------------------------------------
    $('.editStatesForm').submit(function (e) {
        var id = $(this).attr("id");
        e.preventDefault();
        $('#' + id + ".subBtnEdtSts").html('<i class="glyphicon glyphicon-refresh spinner"></i>');
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function () {
                $('#' + id + ".subBtnEdtSts").html('<i class="glyphicon glyphicon-ok"></i>');
            }
        });
    });
// ------------------------------------------
    $('#addNews').submit(function (e) {
        var title = $('#newsTitle').val();
        var body  = $('#newsBody').val();
        var err   = '';
        if (!title) err += "لايوجد عنوان ";
        if (!body) err += "لايوجد محتوى";
        if (err) {
            e.preventDefault();
            alert(err);
        }
    });
// ------------------------------------------
    $('.delState').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var id  = $(this).attr("id");
        // $.get(url);
        $("tr#" + id).fadeOut();
        $.get(url, function (data, status) {
            if (data) {
                alert(data);
            }
            else {
                //
            }
        });
    });
// ------------------------------------------
// admin/form/editcountries
    $('.showHideState').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var id  = $(this).attr("id");
        $('#showHideIcon-' + id).toggleClass('glyphicon-eye-open glyphicon-eye-close');
        $(this).toggleClass("btn-warning btn-primary");
        $.get(url, function (data, status) {
            if (data) {
                alert(data);
            }
            else {
                //
            }
        });
    });
// ------------------------------------------
    $('.delCity').click(function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var id  = $(this).attr("id");
        $.get(url);
        $("tr#" + id).fadeOut();
    });
// ------------------------------------------
    $('.editCitiesForm').submit(function (e) {
        var id = $(this).attr("id");
        e.preventDefault();
        $('#' + id + ".subBtnEdtCty").html('<i class="glyphicon glyphicon-refresh spinner"></i>');
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                $('#' + id + ".subBtnEdtCty").html('<i class="glyphicon glyphicon-ok"></i>');
            }
        });
    });

// ------------------------------------------
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
    $(".editFieldForm").ajaxForm({
        beforeSend: function () {
            pleaseWaitDiv.modal();
        },
        success: function () {
            // -----
        },
        complete: function (response) {
            pleaseWaitDiv.modal('hide');
        }
    });
// ------------------------------------------
    $(".delField").click(function (e) {
        e.preventDefault();
        $(this).closest("tr").fadeOut();
        var url = $(this).attr("href");
        $.get(url);
    });
// ------------------------------------------
    $(".delElement").click(function (e) {
        e.preventDefault();
        $(this).closest("span.subElementsDiv").fadeOut();
        var url = $(this).attr("href");
        $.get(url);
    });
// ------------------------------------------
// long shadow :
    $('[data-shadow]').each(function (i, value) {
        var t     = $(this).data('shadow');
        var n, sh = "", long = 150;
        for (n = 1; n <= long; n++) {
            sh = sh + n + "px " + n + "px " + t;
            if (n != long) sh = sh + ", ";
        }
        $(this).css("text-shadow", sh);
        $(this).css("position", "static");
    });
// end long shadow;
// ------------------------------------------

    $("#mainPartSlct").on("change", function () {
        var t = $(this).find(':selected').data('icon');
        $("#mainPartIcon").removeAttr("class").addClass(t);
        $("#subPartsDiv").html('<h1><i class="glyphicon glyphicon-refresh spinner"></i></h1>')
            .load(base_url + "welcome/subParts/" + $(this).val());
        console.log(t);
    });
// ------------------------------------------
    $('#continueAddAd').click(function (e) {
        e.preventDefault();
        var z = $("#subPartSelect").val();
        if (z == undefined)
            $("#errAddModal").modal();
        else {
            z                    = base_url + "add/" + z;
            window.location.href = z;
        }
    });
// ------------------------------------------
    $(".smallThumbAtPost").click(function (e) {
        e.preventDefault();
        var i = $(this).attr("href");
        $("#bigThumbImgAtPost").attr("src", i);
    });
// ------------------------------------------
    $('#updatePhoneForm').submit(function (e) {
        e.preventDefault();
        $('#phoneBtn').html('<i class="glyphicon glyphicon-refresh spinner"></i>');
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                $('#phoneBtn').html('<i class="glyphicon glyphicon-ok"></i>');
                console.log(data);
            }
        });
    });
// ------------------------------------------
    $('#updateEmail2Form').submit(function (e) {
        e.preventDefault();
        $('#mail2Btn').html('<i class="glyphicon glyphicon-refresh spinner"></i>');
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                $('#mail2Btn').html('<i class="glyphicon glyphicon-ok"></i>');
                console.log(data);
            }
        });
    });
// ------------------------------------------
    $(".pagination a,.pagination strong").addClass("btn btn-sm btn-default");
    $(".pagination strong").addClass("active");
// ------------------------------------------
// التعليقات
    $('#commentTextarea').keypress(function (e) {
        var c = $(this).val();
        if (e.keyCode == 13 && $.trim(c).length) {
            $(this).val(''); // حذف محتوى التعليق
            var i = $("#currentUserImg").attr("src");
            var n = $("#u_name").val();
            $(".media").eq(-2).append('\
        <div class="media">\
  <div class="media-left">\
      <img class="media-object userCommentImg" src="' + i + '" alt="..." />\
  </div>\
  <div class="media-body">\
    <span class="media-heading"><b>' + n + '</b>: ' + c + '</span>\
    <br /><span class="commentDate redText"><i class="fa fa-bell-o"></i> يظهر هذا التعليق بعد موافقة الإدارة</span>\
  </div>\
</div> \
        ');
            // ajax post
            $.ajax({
                type: "POST",
                url: base_url + "welcome/add_comment",
                data: {
                    post_id: $("#post_id").val(),
                    comment: c
                }
            }).done(function (msg) {
                // some code...
            });
            // end ajax post
        } // endif
    }); // end keypress
// ------------------------------------------
// comments script
    $('.commentsTable').on("click", ".btn", function () {
        var id = $(this).attr('id');
        var url;
        if ($(this).hasClass("apply_comment")) {
            $(this).replaceWith('<span class="cancel_comment btn btn-sm btn-info" id="' + id + '"><i class="glyphicon glyphicon-remove"></i> إلغاء الموافقة</span>');
            url = base_url + "control/apply_comment/" + id;
        }
        if ($(this).hasClass("cancel_comment")) {
            $(this).replaceWith('<span class="apply_comment btn btn-sm btn-success" id="' + id + '"><i class="glyphicon glyphicon-ok"></i> موافق</span>');
            url = base_url + "control/desapplay_comment/" + id;
        }
        if ($(this).hasClass("del_comment")) {
            url = base_url + "control/del_comment/" + id;
            $("tr." + id).fadeOut();
        }
        $.post(url);
    });
// end comments;
// ------------------------------------------
// السماح بكتابة 200 حرف فقط في عنوان الاعلان
    $("#postTilte").keyup(function (e) {
        var v = $(this).val();
        var l = v.length;
        console.log(l);
        if (l > 200) $(this).val(v.substring(0, 200));
    });
// ------------------------------------------
    $("#regForm").on("submit", function (e) {
        var err      = "";
        var name     = $("#name").val();
        var email    = $("#email").val();
        var password = $("#password").val();
        if (!name) err += "لم تكتب الاسم" + "<br />";
        if (!email) err += "يرجى إدخال بريد الكتروني صحيح" + "<br />";
        if (!password) err += "يرجى إدخال كلمة مرور صحيحة" + "<br />";
        if (err != "") {
            e.preventDefault();
            $(".modal-body").html(err);
            $('#regModalErrs').modal('show');
        }
    });
// ------------------------------------------
    $("#searchFormHeader").ajaxForm({
        beforeSend: function (e) {
            var ke = $("#keySearchHeader").val();
            if (ke.length <= 2)  e.preventDefault();
            $(".col-lg-8").html(loadingBar); //centerContentDiv
        },
        success: function () {
            // -----
        },
        complete: function (response) {
            var r = response.responseText;
            $(".col-lg-8").html(r); //centerContentDiv
        }
    });
// ------------------------------------------
    $("#lastMore").on("click", function () {
        $(this).before("<div class='col-sm-12 more8div' style='margin:0;padding:0'></div>");
        $(".more8div").html(loadingBar).load(base_url + "welcome/getlast8more");
        $(this).hide();
    });
// ------------------------------------------
    $("#sendMonyDetailsForm").ajaxForm({
        beforeSend: function (e) {
            $("#sent").html(loadingBar);
        },
        success: function () {
            // -----
        },
        complete: function (response) {
            var r = response.responseText;
            $("#sent").html(r);
        }
    });
// ------------------------------------------
    $("#addAmountForm").ajaxForm({
        beforeSend: function (e) {
            $("#addedSuccessPar").html(loadingBar);
        },
        success: function () {/*...*/
        },
        complete: function (response) {
            var r = response.responseText;
            $("#addedSuccessPar").html(r);
        }
    });
// ------------------------------------------
    $('.delPaymentBtn').on("click", function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var h    = href.match(/\d+/g)[0]; //ضع واحد بالاستضافة المحلية وصفر بالموقع
        console.log(h);
        anim($('tr#t' + h), 'shake');
        $.get(href);
    });
// ------------------------------------------
    $('#noDays').on("keyup", function (e) {
        var v  = $(this).val();
        var vv = v.replace(/\D+/g, '');
        $(this).val(vv);
        var c = $("#dailyCostTd").val();
        var t = vv * c;
        console.log(t);
        var d = $("#discountPercent").val();
        $("#advCostTd").html(t + " $");
        var total = t - t * d / 100;
        $("#totalPrice").html(total + " $");
        $("#totalPriceInputText").val(total);
        var b = $("#balance").val();
        if (total == 0) {
            $("#notEnough, #continuePay").addClass("hide");
        }
        if (b <= total && total > 0) {
            $("#notEnough, #continuePay").removeClass("hide");
            $("#notEnough").show();
            $("#continuePay").hide();
        }
        if (b > total && total > 0) {
            $("#notEnough, #continuePay").removeClass("hide");
            $("#notEnough").hide();
            $("#continuePay").show();
        }
    });
// ------------------------------------------
    $("#tellFriendForm").ajaxForm({
        beforeSend: function () {
            $("#mBodyTellFriend").html(loadingBar);
        },
        success: function () { /*...*/
        },
        complete: function (response) {
            var r = response.responseText;
            $("#mBodyTellFriend").html(r);
        }
    });
// ------------------------------------------
// زر حذف الصورة في صفحة تعديل اعلان في الموقع
    $(".delImgFromPostBtn").on("click", function (e) {

        e.preventDefault();
        var imagesUpNames = $("#imagesUpNames");
        var str           = imagesUpNames.val();
        var imgSrc        = $(this).data("img");
        var res           = str.replace(imgSrc, "");
        res               = res.replace(",,", ",");
        res               = res.replace(/(^,)|(,$)/gi, "");
        imagesUpNames.val(res);
        anim($(this).parent().parent(), 'rubberBand');
    });
// ------------------------------------------


    /*
     $("#uploadedImagesRow").on("click", "#deleteUploadedImage", function () {
     var imagesUpNames = $("#imagesUpNames");
     var str           = imagesUpNames.val();
     var imgSrc        = $(this).data("img");
     var res           = str.replace(imgSrc, "");
     res               = res.replace(",,", ",");
     res               = res.replace(/(^,)|(,$)/gi, "");
     console.log(res);
     imagesUpNames.val(res);
     anim($(this).parent().parent().parent(), 'rubberBand');
     allowUploadOneImage();

     });
     */
    $("#spanDeleteImg").on("click", function () {
        var imagesUpNamesEdt = $("#imagesUpNamesEdt");
        var str              = imagesUpNamesEdt.val();
        var imgSrc           = $(this).data("img");
        var res              = str.replace(imgSrc, "");
        res                  = res.replace(",,", ",");
        res                  = res.replace(/(^,)|(,$)/gi, "");
        console.log(res);
        imagesUpNamesEdt.val(res);
        anim($(this).parent().parent().parent(), 'rubberBand');
        $("#imagesUpNamesEdt").show();
    });

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


// main2/addcar
    $("#postForm1").submit(function (e) {
        var err = "";

        var carType = $("#countrySelect").val();
        var carModl = $("#states").val();
        if (carType == "*") err += "نوع السيارة<br />";
        if (carModl == "*") err += "طراز السيارة<br />";
        $("#postForm1 input[type=text]").each(function () {
            var x = $(this).val();
            var y = $(this).data('name');
            if (y && !x) err += (y + "<br />");
        });
        if (err) {
            $("#errModalBodyContent").html(err);
            $("#errModalBtnAddCar").click();
            e.preventDefault();
        }
    });
// ------------------------------------------
// admin/form/view
    $('.detailsRadio').click(function () {
        window.location = base_url + 'manage/form/' + $(this).val();
    });
// ------------------------------------------
    $('.carsRadio').click(function () {
        v = $(this).val();
        $("tr.both, tr.supply, tr.demand").show();
        $("tr." + v).hide();
    });
// ------------------------------------------
    $("tr.both").next(".options").addClass("both");
    $("tr.supply").next(".options").addClass("supply");
    $("tr.demand").next(".options").addClass("demand");
    function hideAllCarFrms() {
        $("tr.both, tr.supply, tr.demand").hide();
    }

    $('.formRadio').click(function () {
        hideAllCarFrms();
        v = $(this).val();
        if (v == 'all') $("tr.both, tr.supply, tr.demand").show();
        if (v == 'both') $("tr.both").show();
        if (v == 'demand') $("tr.demand").show();
        if (v == 'supply') $("tr.supply").show();
    });
// ------------------------------------------

// floating button (header)
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
    $('iframe').wrap('<div class="embed-responsive embed-responsive-16by9">');
// ------------------------------------------
// سعة المحرك تكتب بالشكل x.y
    $('#extra_421').attr("placeholder", "تكتب على شكل رقمين, مثال: 1.2").on('keyup keypress blur change', function (e) {
        $(this).val($(this).val().replace(/[^\/\d]/g, ''));
        if ($(this).val().length > 1)
            $(this).val(
                $(this).val().substring(0, 1) + "." +
                $(this).val().substring(1, 2)
            );
    });
// ------------------------------------------
    $("#extraClientForm").ajaxForm({
        beforeSend: function () {
            $('#savingNow').modal('show');
        },
        success: function () {
            // -----
        },
        complete: function () {
            $('#savingNow').modal('hide');
        }
    });
// ------------------------------------------
}); // end document ready function


