<!-- إضافة جي كويري للكلمات الدلالية  -->
<script src="<?= base_url() ?>assets/bootstrap-3.3.6/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/bootstrap-tagsinput/bootstrap-tagsinput.css">


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
                    <script type="text/javascript" src="<?= base_url() ?>assets/summernote/summernote.js"></script>
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
                        <label for="post_tags"><i class="fa fa-tags"></i> الكلمات المفتاحية: <span class="label_info"> (ضع فاصلة , بين الكلمات) </span></label>
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
        <th>القسم</th>
        <th>الكاتب</th>
        <th>التاريخ</th>
        <th>المشاهدات</th>
        <th>التحكم</th>
    </tr>
    <? foreach ($posts as $p): ?>
        <tr>
            <!-- id -->
            <td><?= $p->post_id ?></td>

            <!-- العنوان -->
            <td>
                <a target="_blank" href="<?= base_url() ?>n-<?= $p->post_id ?>">
                    <i class="ti-pencil-alt"></i> <?= $p->post_title ?>
                </a>
            </td>

            <!-- القسم -->
            <td><i class="ti-view-list"></i> <?= $p->part_title ?> </td>

            <!-- الكاتب -->
            <td><i class="ti-user"></i> <?= $p->user_name ?> </td>

            <!-- تاريخ الإضافة -->
            <td>
                <i class="ti-calendar"></i>
                <time class="timeago" datetime="<?= $p->post_date ?>"><?= $p->post_date ?></time>
            </td>

            <!-- المشاهدات -->
            <td>
                <i class="ti-eye"></i> <?= $p->post_visits ?>
            </td>
            <td>
                <!-- زر الحذف -->
                <a class="btn btn-danger btn-xs delete_post"
                   href="<?= base_url() ?>control/delete_post/<?= $p->post_id ?>"><i
                        class="glyphicon glyphicon-trash"></i></a>

                <!-- زر التعديل -->
                <button data-title="<?= $p->post_title ?>"
                        data-id="<?= $p->post_id ?>"
                        data-part_id="<?= $p->post_part_id ?>"
                        data-tags="<?= $p->post_tags ?>"
                        class="btn btn-xs btn-warning edit_post"
                        data-toggle="modal" data-target="#edit_post_modal">
                    <i class="ti-pencil-alt"></i>
                </button>

            </td>


        </tr>
    <? endforeach; ?>

</table>


<div class="row">
    <div class="col-lg-12">
        <?= $this->pagination->create_links() ?>
    </div>
</div>


<!-- بداية مودال تعديل المقال -->

<div class="modal fade" id="edit_post_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="margin-bottom: 0;" class="modal-header alert alert-warning">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 id="myLargeModalLabel" class="modal-title"><i class="glyphicon glyphicon-plus"></i> تعديل مقال
                </h4></div>
            <div style="padding: 1em;">
                <form role="form" id="edit_post_form" action="<?= base_url() ?>control/edit_post" method="post">

                    <div class="row">
                        <div class="col-md-6"><input type="text" class="form-control" id="post_title_edit"
                                                     name="post_title_edit" placeholder="عنوان المقال"/></div>
                        <div class="col-md-6">

                            <!-- الأقسام -->
                            <select name="post_part_edi" id="post_part_edit" class="form-control">
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

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.summernote_edit').summernote({
                                height: 150,
                                tabsize: 2,
                                direction: 'rtl',
                                lang: 'ar-AR'
                            });
                        });
                    </script>
                    <textarea form="edit_post_form" title="ضع المقال هنا" name="post_content_edit"
                              id="post_content_edit"
                              class="summernote_edit"></textarea>
                    <!-- / محتوى المقال -->

                    <!-- الكلمات الدلالية / المفتاحية -->
                    <div class="form-group">
                        <label for="post_tags_edit"><i class="fa fa-tags"></i> الكلمات المفتاحية: <span
                                class="label_info"> (ضع فاصلة , بين الكلمات) </span></label>
                        <input data-role="tagsinput" type="text" class="form-control" id="post_tags_edit"
                               name="post_tags_edit"/>
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

<!-- نهاية مودال تعديل المقال -->


<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>