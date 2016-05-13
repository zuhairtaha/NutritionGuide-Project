<!-- أسهل مكتبة أعلام الدول: الرابط: https://github.com/lipis/flag-icon-css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.1.0/css/flag-icon.css"/>


<table class="table">
    <thead>
    <th>#</th>
    <th>اسم العضو</th>
    <th>نوع العضوية</th>
    <th>البريد الالكتروني</th>
    <th>تاريخ التسجيل</th>
    <th>آخر دخول</th>
    <th>التحكم</th>
    </thead>
    <tbody>
    <? foreach ($users as $u): ?>
        <tr>

            <!-- العلم والرقم -->
            <td>
                <span class="flag-icon flag-icon-<?= strtolower($u->user_country) ?> "></span>
                <?= $u->user_id ?>
            </td>

            <!-- الاسم -->
            <td>
                <i class="ti-user pull-right"></i>&nbsp;
                <?= $u->user_name ?>
            </td>

            <!-- نوع العضوية -->
            <td>
                <? if ($u->user_role) { ?>
                    <i class="ti-star pull-right"></i>&nbsp;مدير
                <? } else { ?>
                    <i class=" ti-control-record "></i>&nbsp;عضو
                <? } ?>
            </td>

            <!-- البريد الالكتروني -->
            <td>
                <i class="ti-email pull-right"></i>&nbsp;
                <?= $u->user_email ?>
            </td>

            <!-- تاريخ التسجيل -->
            <td>
                <i class="fa fa-calendar pull-right"></i>&nbsp;
                <time class="timeago" datetime="<?= $u->user_registration_date ?>"></time>
            </td>

            <!-- آخر دخول -->
            <td>
                <i class="ti-timer pull-right"></i>&nbsp;
                <time class="timeago" datetime="<?= $u->user_last_login ?>"></time>
            </td>

            <!-- التحكم -->
            <td>
                <a href="<?= base_url() ?>control/edit_user/<?= $u->user_id ?>" class="btn btn-xs btn-warning"><i
                        class="ti ti-pencil-alt"></i></a>
            </td>

        </tr>
    <? endforeach; ?>
    </tbody>
</table>