/* 12-6-2016 */

/* تابع إذا كان العنصر موجود */
function checkDom(dom) {
    return !!(typeof(dom) != 'undefined' && dom != null);
}

$(function () {
    var inputFile = $('input#file');
    var iUF       = $("#imgsUpForm");
    var uploadURI = iUF.attr('action');
// var progressBar = $('#progress-bar');
    $("#upPercent").html("");
    iUF.hide();
// listFilesOnServer();

// ------------------------------------------
    $("#visibleUpImgsBtn").click(function () {
        $("#file").click();
    });
// ------------------------------------------
    $("#file").change(function () {
        $("#upMultiImgsBtn").click();
    });
// ------------------------------------------
    $('#upMultiImgsBtn').on("click", function (event) {

        var filesToUpload = inputFile[0].files;
        // make sure there is file(s) to upload
        if (filesToUpload.length > 0) {
            // provide the form data
            // that would be sent to sever through ajax
            var formData = new FormData();
            for (var i = 0; i < filesToUpload.length; i++) {
                var file = filesToUpload[i];
                formData.append("file[]", file, file.name);
            }
            $('#upIcon').addClass("fa-refresh fa-spin fa-fw margin-bottom").removeClass("fa-upload");
            // now upload the file using $.ajax
            $.ajax({
                url: uploadURI,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (dta) {
                    //console.log(dta);
                    //return;
                    // push imgs to editor:
                    var json = $.parseJSON(dta);
                    $.each(json, function (index, value) {
                        //console.log(value);
                        //console.log(uploadPath + value);
                        var img_url = uploadPath + value;
                        var apnd    = '<img class="img-responsive" src="' + uploadPath + value + '"/><br />';

                        /* إضافة رابط الصورة في صفحة إضافة بنر */
                        var current_url = window.location.pathname;
                        if (current_url.match(/add_banner/gi)) {
                            $("#image").val(img_url);
                            $("#div_img_banner").html(apnd);
                        }

                        /* إضافة الصور المرفوعة إلى محرر summernote بعهد الانتهاء */
                        /* http://summernote.org/deep-dive */
                        if (current_url.match(/posts|edit_post/gi)) {
                            $(".summernote").summernote("insertImage", img_url, '');
                        }
                    });
                    //$('.progress').hide(); // hide after complete
                    $('#upIcon').removeClass("fa-refresh fa-spin fa-fw margin-bottom").addClass("fa-upload");
                    $('#upPercent').html("");
                    // end push imgs to editor;
                },
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (event) {
                        if (event.lengthComputable) {
                            var percentComplete = Math.round((event.loaded / event.total) * 100);
                            $('#upPercent').html(" (" + percentComplete + ")");
                            // console.log(percentComplete);
                            //$('.progress').show();
                            //progressBar.css({width: percentComplete + "%"});
                            //progressBar.text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                }
            });
        }
    });
// ------------------------------------------
    function listFilesOnServer() { // not used now
        var items = [];
        $.getJSON(uploadURI, function (data) {
            $.each(data, function (index, element) {
                items.push('<li class="list-group-item">' + element + '<div class="pull-right"><a href="#" data-file="' + element + '" class="remove-file"><i class="glyphicon glyphicon-remove"></i></a></div></li>');
            });
            $('.list-group').html("").html(items.join(""));
        });
    }

// ------------------------------------------
    $('.note-btn[data-original-title="Cleaner"]').html('<i class="ti-paint-bucket"></i>');

});