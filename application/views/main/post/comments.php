<p class="alert alert-info"><i class="fa fa-comments"></i>
    <b>التعليقات</b>

    <span class="badge"><?=count($comments)?></span>
</p>
<div id="comments">
    <!-- عرض التعليقات -------------------------------------- -->

    <? if($comments): foreach($comments as $comment): ?>
    <div class="media margin-bottom-1">
        <div class="media-left">
            <!-- الصورة \ الأيقونة -->
            <div class="comment_user_photo"><i class="fa fa-user"></i></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <!-- ترويسة الميديا: اسم العضو -->
                <b> <?= $comment->user_name ?> </b>
            </h4>
            <!-- التعليق هنا -->
            <?= strip_tags($comment->comment_content) ?>
            <p class="gray_color">
                <i class="fa fa-clock-o"></i>
                <time class="timeago" datetime="<?= $comment->comment_date ?>"><?= $comment->comment_date ?></time>
            </p>

        </div>
    </div>
    <? endforeach; endif; ?>


</div>


<!-- ------------------------------- إضافة تعليق -->
<? if ($this->session->logged_in): ?>
    <form action="<?= base_url() ?>add_comment" method="post" id="add_comment_form">
        <div class="media margin-bottom-1">
            <div class="media-left">
                <!-- الصورة \ الأيقونة -->
                <div class="comment_user_photo"><i class="fa fa-user"></i></div>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    <!-- ترويسة الميديا: اسم العضو -->
                    <b> <?= $this->session->user_name ?> </b>
                </h4>
                <!-- التعليق هنا -->
                <input type="hidden" name="comment_post_id" id="comment_post_id" value="<?= $post_id ?>"/>
                <input type="hidden" name="comment_user_name" id="comment_user_name" value="<?= $this->session->user_name ?>"/>
                <input type="hidden" name="comment_user_id" id="comment_user_id"
                       value="<?= $this->session->user_id ?>"/>
                    <textarea name="comment_content" id="comment_content" class="form-control auto_grow"
                              placeholder="ضع تعليقك هنا ..."> </textarea>
                <button type="submit" class="btn btn-sm btn-primary margin-top-1"><i class="fa fa-plus"></i> أضف
                    التعليق
                </button>

            </div>
        </div>
    </form>
<? endif; ?>
<!-- ------------------------------------------ -->