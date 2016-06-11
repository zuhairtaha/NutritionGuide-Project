<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a></li>
    <li><a href="<?= current_url() ?>"><i class="ti-comment-alt"></i> تعليقاتي</a></li>
</ol>
<table class="table">
    <thead>
    <tr>
        <th class="centerText">#</th>
        <th>التاريخ</th>
        <th>التعليق</th>
        <th>الموضوع</th>
        <th></th>

    </tr>
    </thead>
    <tbody>


    <? foreach ($comments as $c): ?>
        <tr>
            <!-- ID -->
            <td class="centerText"><?= $c->comment_id ?></td>

            <!-- التاريخ -->
            <td>
                <i class="ti-alarm-clock"></i>
                <time class="timeago" datetime="<?= $c->comment_date ?>"></time>
            </td>

            <!-- التعليق -->
            <td>
                <i class="ti-comment pull-right"></i>&nbsp;<?= strip_tags($c->comment_content) ?>
            </td>

            <!-- المقال -->
            <td>
                <a href="<?= $c->comment_post_id ?>">
                    <i class="ti-pencil-alt pull-right"></i>&nbsp;<?= $c->post_title ?>
                    <a>
            </td>

            <!-- الموافقة أم لا -->
            <td>
                <? if ($c->comment_approved == 0) { ?>
                    <i class="fa fa-hourglass-end"></i> بانتظار الموافقة
                <? } ?>
            </td>

        </tr>

    <? endforeach; ?>
    </tbody>
</table>