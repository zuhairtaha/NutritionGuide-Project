<!-- إضافة جي كويري لعرض التاريخ بصيغة (منذ ... مضت) -->
<script src="<?= base_url() ?>assets/js/jquery.timeago.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.timeago.ar.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("time.timeago").timeago();
    });
</script>


<table class="table">
    <thead>
    <th>#</th>
    <th>اسم العضو</th>
    <th>نوع العضوية</th>
    <th>البريد الالكتروني</th>
    <th>تاريخ التسجيل</th>
    <th>آخر دخول</th>
    </thead>
    <tbody>
    <? foreach ($users as $u): ?>
        <tr>
            <td><?= $u->user_id ?></td>
            <td>
                <i class="ti-user"></i>
                <?= $u->user_name ?>
            </td>
            <td>
                <i class="ti-star"></i>
                <?= $u->user_role ?>
            </td>
            <td>
                <i class="ti-email"></i>
                <?= $u->user_email ?>
            </td>
            <td>
                <i class="ti-calendar"></i>
                <?= $u->user_registeration_date ?>
            </td>
            <td>
                <i class="ti-timer"></i>
                <time class="timeago" datetime="<?= $u->user_last_login ?>"></time>
            </td>

        </tr>
    <? endforeach; ?>
    </tbody>
</table>