<script>
    function ttype(s) {
        return s.substring(s.lastIndexOf('.') + 1).toLowerCase();
    }
    // ------------------------------------------
    function nname(s) {
        s = s.replace(/\\/g, '/');
        return s.substring(s.lastIndexOf('/') + 1, s.lastIndexOf('.'));
    }
    // ------------------------------------------
    $(".browseFile1").click(function () {
        $("#browseFile").click();
        $("#progress").show();
    });
    // ------------------------------------------
    $("#browseFile").change(function () {
        // tutorial at:
        // https://developer.mozilla.org/en-US/docs/Using_files_from_web_applications
        var x = $(this).val();
        // check file size
        var size = this.files[0].size;
        size /= 1000000;
        $('#fileSize').val(size);
        if (size > 10) {
            alert("الحجم غير مقبول");
            return false;
        } // end of check file size;

        // check file type:
        var type = ttype(x);
        $('#fileType').val(type);

        if (type == 'jpeg' || type == 'jpg' || type == 'gif' || type == 'png' || type == 'pdf') {
        }
        else {
            alert(type + "النوع غير مقبول");
            return false;
        }
        $("#myForm").submit();

    });
    // ------------------------------------------
    $('.browseFile1').tooltip();

    // ------------------------------------------
    $("#stampspan").click(function () {
        $("#checkboxStamp").click();
        $("#withStamp1").change();
    });
    $("#checkboxStamp").change(function () {
        $("#withStamp1").click();
    });

    // ------------------------------------------ script end;
</script>

<form role="form" id="myForm" action="<?= base_url() ?>upload/up2" method="post" enctype="multipart/form-data">
    <input class="form-control hide" id="browseFile" type="file" name="myfile"/>
    <button data-toggle="tooltip" data-placement="top" title="يسمح فقط برفع الصور" type="button"
            class="browseFile1 btn btn-danger">
        <span class="glyphicon glyphicon-picture"></span> رفع صور
    </button>

    <? if ($this->session->logged_in_admin) { ?>
        <span id="checkBoxStampSpan">
     <input type="checkbox" checked="checked" name="withStamp" id="checkboxStamp"/>
     <span style="cursor: pointer;" id="stampspan">ختم بشعار الموقع</span>
     <input checked="btn btn-default" id="upBtn" type="submit" value="رفع صور"/>
     </span>
    <? } ?>
</form><br/>

<div class="progress" id="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" id="bar" role="progressbar" aria-valuenow="60"
         aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
        <span id="percent">0%</span>
    </div>
</div>

<div id="message"></div>
<script src="<?= base_url() ?>assets/js/upload.js"></script>
