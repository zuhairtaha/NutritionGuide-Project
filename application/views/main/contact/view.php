<!-- sinding main box ------------------------------------------------------ -->
<div style="direction: rtl; text-align: right;" class="modal fade mailingBox" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 id="mySmallModalLabel2" class="modal-title center">جاري الإرسال</h4>
            </div>
            <div id="resultHere2" class="modal-body">
                <div class="progress left">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                         aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /sinding main box ------------------------------------------------------ -->


<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> الرئيسة</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-envelope"></i> اتصل بنا</a></li>
</ol>

<form method="post" role="form" class="form sendMailForm" action="<?= base_url() ?>welcome/send_mail">

    <div class="form-group">
        <label for="name"> الاسم</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="الاسم"/>
    </div>

    <div class="form-group">
        <label for="email"> البريد الإلكتروني</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="البريد الإلكتروني"/>
    </div>

    <div class="form-group">
        <label for="subject"> عنوان الرسالة</label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="عنوان الرسالة"/>
    </div>

    <div class="form-group">
        <label for="msg"> محتوى الرسالة</label>
        <textarea class="form-control" id="msg" name="msg" placeholder="محتوى الرسالة"></textarea>
    </div>

    <button type="submit" class="btn btn-success btn-block btn-lg"><i
            class="glyphicon glyphicon-send"></i> إرسال
    </button>
</form>