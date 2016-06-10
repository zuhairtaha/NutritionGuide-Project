<p>تفيد سجلاتنا بأنك مسجل مسبقاً بهذا البريد الإلكتروني</p>
<p>يمكنك التوجه إلى زر تسجيل الدخول الموجود أعلاه</p>
<p>أما إذا كنت نسيت كلمة المرور يمكنك إعادة ضبط كلمة المرور خاصتك وسترسل الكلمة الجديدة عبر بريدك الالكتروني</p>

<form id="restPassForm" class="form" action="<?= base_url() ?>admin_login/reset" method="post">
    <input class="form-control" type="hidden" name="email1" value="<?=$user_email?>" />
    <button class="btn btn-primary" type="submit">
        <i class="glyphicon glyphicon-envelope"></i>
        إرسال كلمة مرور جديدة
    </button>
</form>

<br /><p id="notes"></p>
