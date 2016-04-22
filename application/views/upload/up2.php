<?
function getExt($str)
{
    $re = "/\\.\\w+$/i";
    preg_match($re, $str, $matches);
    return str_replace(".", "", $matches[0]);
}

// ------------------------------------------
$output_dir = './assets/uploads/';
$out        = base_url() . 'assets/uploads/';

if (isset($_FILES["myfile"])) {
    $f        = $_FILES["myfile"];
    $fileName = $f['name'];
    $ext      = getExt($fileName);
    $tmp      = time() . "." . $ext;
    $new_name = $output_dir . $tmp;
    $path     = $out . $tmp;

    //Filter the file types , if you want.
    if ($_FILES["myfile"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    } else {
        //move the uploaded file to uploads folder;
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $new_name);

        ?>
        <script>
            /* لمنع رفع أكثر من صورة للتصنيفات الأغذاية عن طريق إخفاء الزر إذا كانت هناك صورة مرفوعة */
            function allowUploadOneImage() {
                if ($("#imagesUpNames").val()) {
                    $("#uploadImgs").hide();
                }
                else $("#uploadImgs").show();
            }
            // ------------------------------------------

            function pushPath(el) {
                // puth the value of image uploded to input text..
                var element = document.getElementById(el);
                if (typeof(element) != 'undefined' && element != null)
                    element.value = "<?php echo $path; ?>";
            }
            // ------------------------------------------


            $("#progress").hide();
            img = "<img class='thumbnail' src='<?= $path ?>'  />";
            pureImg = "<img src='<?= $path ?>'  />";
            thumbImg = "<img src='<?=$out.'thumb_'.$tmp ?>'  />";
            $(".panel-body").append(pureImg);
            var img_src = '<?= $out.'thumb_'.$tmp ?>';
            if (typeof page === 'undefined') {
                thumb_img = "<img class='thumbnail' src='<?= $out.'thumb_'.$tmp ?>'  />";
            }
            else {
                thumb_img = '<div  class="thumbnail">\
                    <img src="<?= $out.'thumb_'.$tmp ?>" />\
                    <div class="caption delImgCaptionBtn">\
                    </div>\
                </div>';
            }


            var ext = '<?=$ext?>';

            pushPath('upBanner');
            pushPath('background');
            pushPath('imageForSlider');
            // ------------------------------------------
            var T = $("#imagesUpNames").val();
            if (T == "") {
                $("#imagesUpNames").val(T + "<?=$tmp?>");
            }
            else {
                $("#imagesUpNames").val(T + ",<?=$tmp?>");
            }
            $.post(base_url + "upload/creatThumb/<?=$tmp?>", function () {
                $("#uploadedImagesRow").append(
                    '<div class="col-sm-6 col-md-4"><div class="thumbnail">' + thumbImg +
                    '<div class="caption"><span role="button"  class="deleteUploadedImage btn btn-danger btn-xs btn-block" ' +
                    ' data-img="<?=$tmp?>" ><i class="glyphicon glyphicon-trash"></i> حذف</span></div></div></div>'
                );
            });


            allowUploadOneImage();
            // ------------------------------------------
            // profile upload image
            var segment1 = "<?=$this->uri->segment(1)?>";
            if (segment1 == "usercp") {
                img2 = '<p><img class="img-responsive img-thumbnail" style="max-width: 400px;" src="<?=$path?>" /></p>';
                img2 += '<p  class="btn btn-warning btn-sm" id="add_images" onclick="sh()">\
             <i class="glyphicon glyphicon-edit"></i> تعديل صورة</p>\
             <div class="upload" id="upload">\
                <div id="up_form"></div>\
             </div>';
                if (typeof(imgTd) != 'undefined' && imgTd != null && ext != 'pdf')
                    imgTd.innerHTML = img2;
                $.post(base_url + "upload/updatePhoto", {url: "<?= $path ?>"}, function (result) {
                    console.log(result);
                });
            }
            // end profile upload image


        </script>
        <?
    }
}
?>



