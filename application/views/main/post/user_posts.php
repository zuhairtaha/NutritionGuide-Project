<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a></li>
    <li><a href="<?= current_url() ?>"><i class="ti-pencil-alt"></i> مقالاتي</a></li>
</ol>
<table class="table">
    <thead>
    <tr>
        <th class="centerText">#</th>
        <th>التاريخ</th>
        <th>المقال</th>
        <th>القسم</th>
        <th class="centerText">المشاهدات</th>
        <th></th>

    </tr>
    </thead>
    <tbody>


    <? foreach ($posts as $p): ?>
        <tr>
            <!-- id -->
            <td class="centerText"><?= $p->post_id ?></td>

            <!-- التاريخ -->
            <td>
                <i class="ti-alarm-clock"></i>
                <time class="timeago" datetime="<?= $p->post_date ?>"></time>
            </td>

            <!-- عنوان المقال -->
            <td><a href="<?= base_url($p->post_id) ?>"><i class="ti-pencil-alt"></i>&nbsp;<?= $p->post_title ?></a></td>

            <!-- القسم -->
            <td><a href="<?= base_url("part/" . $p->post_part_id) ?>"><i
                        class="ti-view-list"></i>&nbsp;<?= $p->part_title ?></a></td>

            <!-- المشاهدات -->
            <td class="centerText"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;<?= $p->post_visits ?> </td>

            <!-- الموافقة أم لا -->
            <td>
                <? if ($p->post_approved == 0) { ?>
                    <i class="fa fa-hourglass-end"></i> بانتظار الموافقة
                <? } ?>
            </td>
        </tr>

    <? endforeach; ?>
    </tbody>
</table>