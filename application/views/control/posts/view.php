<!-- إضافة جي كويري للكلمات الدلالية  -->
<script src="<?= base_url() ?>assets/bootstrap-3.3.6/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/bootstrap-tagsinput/bootstrap-tagsinput.min.css">


<!-- upload form -------------- -->
<form class="hide" action="<?= base_url() ?>upload/uploadMultiImgs" id="imgsUpForm" enctype="multipart/form-data"
      method="post" accept-charset="utf-8">
    <input type="file" name="file[]" multiple="multiple" id="file" accept="image/*"/>

    <p class="btn btn-primary" id="upMultiImgsBtn"></p>
</form> <!-- /upload form -->

<p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_post_modal">
        <i class="glyphicon glyphicon-plus"></i>
        إضافة مقال
    </button>
</p>

<style type="text/css">
    #checkBoxStampSpan {
        display: none
    }
</style>
<!-- مودال إضافة مقال -->
<div class="modal fade" id="add_post_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="margin-bottom: 0;" class="modal-header alert alert-warning">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 id="myLargeModalLabel" class="modal-title"><i class="glyphicon glyphicon-plus"></i> إضافة مقال جديد
                </h4></div>
            <div style="padding: 1em;">
                <form role="form" id="add_post_form" action="<?= base_url() ?>control/add_post" method="post">

                    <div class="row">
                        <div class="col-md-6"><input type="text" class="form-control" id="post_title"
                                                     name="post_title" placeholder="عنوان المقال"/></div>
                        <div class="col-md-6">

                            <select name="post_part" id="post_part" class="form-control">
                                <option disabled="disabled" selected="selected" value="0">اختر القسم</option>
                                <? foreach ($parts as $part): ?>
                                    <option value="<?= $part->part_id ?>"><?= $part->part_title ?></option>
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
                    <script type="text/javascript" src="<?= base_url() ?>assets/summernote/summernote.min.js"></script>
                    <script type="text/javascript"
                            src="<?= base_url() ?>assets/summernote/lang/summernote-ar-AR.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.summernote').summernote({
                                height: 150,
                                tabsize: 2,
                                direction: 'rtl',
                                lang: 'ar-AR'
                            });
                        });
                    </script>
                    <textarea form="add_post_form" title="ضع المقال هنا" name="post_content" id="post_content"
                              class="summernote"></textarea>
                    <!-- / محتوى المقال -->

                    <!-- الكلمات الدلالية / المفتاحية -->
                    <div class="form-group">
                        <label for="post_tags"><i class="fa fa-tags"></i> الكلمات المفتاحية: <span class="label_info"> (ضع فاصلة بين الكلمات) </span></label>
                        <input data-role="tagsinput" type="text" class="form-control" id="post_tags" name="post_tags">
                    </div>

                    <!-- آي دي الكاتب -->
                    <input type="hidden" name="author_id" value="<?= $this->session->user_id ?>"/>

                    <button type="submit" class="btn btn-primary btn-block"><i
                            class="ti-save"></i> حفظ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- نهاية مودال إضافة مقال -->
<table class="table">
    <tr>
        <th>#</th>
        <th>العنوان</th>
        <th class="visible-lg visible-md visible-sm">القسم</th>
        <th class="visible-lg visible-md">الكاتب</th>
        <th class="visible-lg visible-md">التاريخ</th>
        <th class="visible-lg visible-md">المشاهدات</th>
        <th>التحكم</th>
    </tr>
    <? foreach ($posts as $p): ?>
        <tr>
            <!-- id -->
            <td><?= $p->post_id ?></td>

            <!-- العنوان -->
            <td>
                <a target="_blank" href="<?= base_url() ?><?= $p->post_id ?>">
                    <i class="ti-pencil-alt"></i> <?= $p->post_title ?>
                </a>
            </td>

            <!-- القسم -->
            <td class="visible-lg visible-md visible-sm"><i class="ti-view-list"></i> <?= $p->part_title ?> </td>

            <!-- الكاتب -->
            <td class="visible-lg visible-md"><i class="ti-user pull-right"></i>&nbsp;<?= $p->user_name ?> </td>

            <!-- تاريخ الإضافة -->
            <td class="visible-lg visible-md">
                <i class="ti-alarm-clock pull-right"></i>&nbsp;
                <time class="timeago" datetime="<?= $p->post_date ?>"><?= $p->post_date ?></time>
            </td>

            <!-- المشاهدات -->
            <td class="visible-lg visible-md">
                <i class="ti-eye pull-right"></i>&nbsp; <?= $p->post_visits ?>
            </td>
            <td>
                <!-- زر الحذف -->
                <a class="btn btn-danger btn-xs delete_post"
                   href="<?= base_url() ?>control/delete_post/<?= $p->post_id ?>"><i
                        class="glyphicon glyphicon-trash"></i></a>

                <!-- زر التعديل -->

                <a href="<?= base_url() ?>control/edit_post/<?= $p->post_id ?>" class="btn btn-xs btn-warning">
                    <i class="ti-pencil-alt"></i>
                </a>

                <!-- زر الموافقة أو عدمها -->
                <? if ($p->post_approved) $AppClass = "btn-success"; else $AppClass = "btn-default"; ?>
                <a href="<?= base_url() ?>control/approve_post/<?= $p->post_id ?>"
                   class="btn <?= $AppClass ?> btn-xs approvePost"><i class="ti-check"></i>
                </a>

            </td>


        </tr>
    <? endforeach; ?>

</table>


<div class="row">
    <div class="col-lg-12">
        <?= $this->pagination->create_links() ?>
    </div>
</div>


<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>