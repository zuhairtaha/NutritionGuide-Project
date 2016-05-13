<table class="table">
    <thead>
    <th>#</th>
    <th>التعليق</th>
    <th>بواسطة</th>
    <th>على المقال</th>
    <th>التاريخ</th>
    <th>التحكم</th>
    </thead>
    <tbody>
    <? foreach ($comments as $comment): ?>
        <tr>
            <!-- رقم التعليق -->
            <td><?= $comment->comment_id ?></td>

            <!-- التعليق -->
            <td><i class="ti-comment pull-right"></i>&nbsp; <?= strip_tags($comment->comment_content) ?></td>

            <!-- اسم صاحب التعليق -->
            <td><i class="ti-user pull-right"></i>&nbsp; <?= $comment->user_name ?></td>

            <!-- عنوان المقال -->
            <td><i class="ti-pencil-alt pull-right"></i>&nbsp; <?= $comment->post_title ?></td>

            <!-- التاريخ -->
            <td><i class="ti-alarm-clock pull-right"></i>&nbsp;
                <time class="timeago" datetime="<?= $comment->comment_date ?>"><?= $comment->comment_date ?></time>
            </td>

            <!-- التحكم -->
            <td>
                <!-- زر الحذف -->
                <a href="<?= base_url() ?>control/delete_comment/<?= $comment->comment_id ?>"
                   class="btn btn-danger btn-xs deleteComment"><i class="glyphicon glyphicon-trash"></i>
                </a>

                <!-- زر الموافقة أو عدمها -->
                <? if ($comment->comment_approved) $AppClass = "btn-success"; else $AppClass = "btn-default"; ?>
                <a href="<?= base_url() ?>control/approve_comment/<?= $comment->comment_id ?>"
                   class="btn <?= $AppClass ?> btn-xs approveComment"><i class="ti-check"></i></a>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>