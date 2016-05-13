<? $u = $user[0]; ?>
<form id="user_edit_form" action="<?= base_url() ?>control/update_user" method="post" accept-charset="utf-8">

    <input type="hidden" value="<?=$u->user_id?>" name="user_id" />

    <div class="form-group">
        <label for="user_name"><i class="ti-user"></i> اسم المستخدم</label>
        <input type="text" placeholder="اسم المستخدم" name="user_name" id="user_name" class="form-control"
               value="<?= $u->user_name ?>">
    </div>

    <div class="form-group">
        <label for="user_email"><i class="ti-email"></i> البريد الإلكتروني</label>
        <input type="text" placeholder="البريد الإلكتروني" name="user_email" id="user_email" class="form-control"
               value="<?= $u->user_email ?>">
    </div>

    <div class="form-group">
        <label for="user_phone_number"><i class="ti-mobile"></i> رقم الهاتف</label>
        <input type="text" placeholder="رقم الهاتف" name="user_phone_number" id="user_phone_number" class="form-control"
               value="<?= $u->user_phone_number ?>">
    </div>

    <div class="form-group">
        <label for="user_about"><i class="ti-info"></i> حول العضو</label>
        <input type="text" placeholder="حول العضو" name="user_about" id="user_about" class="form-control"
               value="<?= $u->user_about ?>">
    </div>

    <button class="btn btn-success">
        <i id="save-loading" class="fa fa-spinner fa-spin fa-fw margin-bottom"></i>
        <i id="save-action" class="ti-save"></i>
        حفظ</button>

</form>
