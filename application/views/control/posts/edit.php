<!-- إضافة جي كويري للكلمات الدلالية  -->
<script src="<?= base_url() ?>assets/bootstrap-3.3.6/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/bootstrap-tagsinput/bootstrap-tagsinput.css">


<!-- upload form -------------- -->
<form class="hide" action="<?= base_url() ?>upload/uploadMultiImgs" id="imgsUpForm" enctype="multipart/form-data"
      method="post" accept-charset="utf-8">
    <input type="file" name="file[]" multiple="multiple" id="file" accept="image/*"/>

    <p class="btn btn-primary" id="upMultiImgsBtn"></p>
</form> <!-- /upload form -->


<? $p = $post[0]; ?>
<form role="form" id="add_post_form" action="<?= base_url() ?>control/add_post" method="post">

    <div class="row">
        <div class="col-md-6"><input type="text" class="form-control" id="post_title" value="<?= $p->post_title ?>"
                                     name="post_title" placeholder="عنوان المقال"/></div>
        <div class="col-md-6">

            <select name="post_part" id="post_part" class="form-control">
                <option disabled="disabled" selected="selected" value="0">اختر القسم</option>
                <? foreach ($parts as $part): ?>
                    <option <? if ($p->post_part_id == $part->part_id) echo 'selected="selected"'; ?>
                        value="<?= $part->part_id ?>"><?= $part->part_title ?></option>
                <? endforeach; ?>
            </select>

        </div>


    </div>

    <!-- تحميل الصور -->
    <p style="margin:0.5em 0" title="لرفع الصور فقط" id="visibleUpImgsBtn" class="btn btn-success">
        <i id="upIcon" class="ti-upload"></i> رفع الصور <span id="upPercent">(0%)</span></p>
    <script> var uploadPath = "<?=base_url()?>assets/uploads/"; </script>

    <!-- / تحميل الصور -->

    <!--   محتوى المقال -->
    <!-- include summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/summernote/summernote.css"/>
    <script type="text/javascript" src="<?= base_url() ?>assets/summernote/summernote.js"></script>
    <script type="text/javascript"
            src="<?= base_url() ?>assets/summernote/lang/summernote-ar-AR.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 300,
                tabsize: 2,
                direction: 'rtl',
                lang: 'ar-AR'
            });
        });
    </script>

    <textarea form="add_post_form" title="ضع المقال هنا" name="post_content"
              id="post_content" class="summernote"> <?= $p->post_content ?> </textarea>
    <!-- / محتوى المقال -->

    <!-- الكلمات الدلالية / المفتاحية -->
    <?

    $tags = str_replace('،', '-', $p->post_tags);
    $tags = str_replace('-', ',', $tags);
    $tags = str_replace(' ', '', $tags);
    ?>
    <div class="form-group">
        <label for="post_tags"><i class="fa fa-tags"></i> الكلمات المفتاحية: <span class="label_info"> (ضع فاصلة بين الكلمات) </span></label>
        <input value="<?= $tags ?>" data-role="tagsinput" type="text" class="form-control" id="post_tags"
               name="post_tags"/>
    </div>

    <!-- آي دي الكاتب -->
    <input type="hidden" name="author_id" value="<?= $this->session->user_id ?>"/>

    <button type="submit" class="btn btn-primary btn-block"><i
            class="ti-save"></i> حفظ
    </button>
</form>


<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>