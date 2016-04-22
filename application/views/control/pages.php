<!-- upload form -------------- -->
<form class="hide" action="<?= base_url() ?>upload/uploadMultiImgs" id="imgsUpForm" enctype="multipart/form-data"
      method="post" accept-charset="utf-8">
    <input type="file" name="file[]" multiple="multiple" id="file" accept="image/*"/>

    <p class="btn btn-primary" id="upMultiImgsBtn"></p>
</form> <!-- /upload form -->

<div class="row">
    <div class="col-lg-12">
        <p class="btn btn-primary" data-toggle="modal" data-target=".PagesModal-lg">
            <i class="glyphicon glyphicon-plus"></i>
            إضافة صفحة جديدة
        </p>
    </div>
</div>

<style type="text/css">
    #checkBoxStampSpan {
        display: none
    }
</style>
<!-- مودال إضافة صفحة -->
<div class="modal fade PagesModal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="margin-bottom: 0;" class="modal-header alert alert-warning">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 id="myLargeModalLabel" class="modal-title"><i class="glyphicon glyphicon-plus"></i> إضافة صفحة جديدة
                </h4></div>
            <div style="padding: 1em;">
                <form role="form" id="addPages" action="<?= base_url() ?>control/addPage" method="post">
                    <div class="row titleAndLevel">
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-md-12" id="title" name="title"
                                   placeholder="عنوان الصفحة"/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-md-12" id="pageLevel" name="pageLevel"
                                   placeholder="الترتيب"/>
                        </div>
                    </div>

                    <!-- تحميل الصور -->
                    <p style="margin:0.5em 0" title="لرفع الصور فقط" id="visibleUpImgsBtn" class="btn btn-success">
                        <i id="upIcon" class="fa fa-upload"></i> رفع الصور <span id="upPercent">(0%)</span></p>
                    <script> var uploadPath = "<?=base_url()?>assets/uploads/"; </script>

                    <!-- / تحميل الصور -->

                    <!--   محتوى الصفحة -->
                    <!-- include summernote -->
                    <link rel="stylesheet" href="<?= base_url() ?>assets/summernote/summernote.css"/>
                    <script type="text/javascript" src="<?= base_url() ?>assets/summernote/summernote.js"></script>
                    <script type="text/javascript"
                            src="<?= base_url() ?>assets/summernote/lang/summernote-ar-AR.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.summernote').summernote({
                                height: 250,
                                tabsize: 2,
                                direction: 'rtl',
                                lang: 'ar-AR'
                            });
                        });
                    </script>
                    <textarea form="addPages" title="ضع الصفحة هنا" name="pageBody" id="PageBody"
                              class="summernote"></textarea>
                    <!-- / محتوى الصفحة -->


                    <button type="submit" class="btn btn-primary btn-block"><i
                            class="ti-save"></i> حفظ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- نهاية مودال إضافة صفحة -->

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>الترتيب</th>
        <th>العنوان</th>
        <th>التاريخ</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($pages as $n): ?>
        <tr>
            <td><?= $n->page_id ?></td>
            <td><?= $n->page_level ?></td>
            <td><a target="_blank" href="<?= base_url() ?>n-<?= $n->page_id ?>"><i
                        class="ti-files"></i> <?= $n->page_title ?></a></td>
            <?
            $ca = $n->page_created_at;
            $ua = $n->page_updated_at;
            $dt = max($ca, $ua);
            if ($ca > $ua) $dt = " تاريخ الإنشاء: " . $ca;
            else $dt = " تاريخ التحديث: " . $ua;
            ?>
            <td><i class="ti-calendar"></i> <?= $dt ?> </td>
            <td>
                <a class="btn btn-danger btn-xs deletePage"
                   href="<?= base_url() ?>control/deletePage/<?= $n->page_id ?>"><i
                        class="glyphicon glyphicon-trash"></i></a>
                <button data-title="<?= $n->page_title ?>"
                        data-level="<?= $n->page_level ?>"
                        data-id="<?= $n->page_id ?>"
                        class="btn btn-xs btn-warning editPages"
                        data-toggle="modal" data-target=".EdtPagesModal-lg"><i class="ti-pencil-alt"></i>
                </button>
            </td>


        </tr>
    <? endforeach; ?>
    </tbody>
</table>


<!-- بداية مودال تعديل الصفحة -->
<div class="modal fade EdtPagesModal-lg editPagesDivModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabeEdt">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="margin-bottom: 0;" class="modal-header alert alert-warning">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 id="myLargeModalLabeEdt" class="modal-title"><i class="ti-pencil-alt"></i> تعديل صفحة
                </h4></div>
            <div id="postEditContnt" style="padding: 1em;">
                <!-- المحتوى هنا يحضر بالاجاكس -->
                <form role="form" id="editPagesForm" action="" method="post">


                    <div class="row titleAndLevel">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="PageTitleEdit" name="PagesTitle"
                                   placeholder="عنوان الصفحة يكتب هنا"/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="PageLevel" name="PageLevel"
                                   placeholder="الترتيب"/>
                        </div>
                    </div>
                    <input type="hidden" id="PagesIdEdit" name="PagesIdEdit"/>

                    <!--   محتوى الصفحة -->
                    <!-- include summernote -->
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.summernote2').summernote({
                                height: 280,
                                tabsize: 2,
                                direction: 'rtl',
                                lang: 'ar-AR'
                            });
                        });
                    </script>
                    <textarea form="editPagesForm" name="PageBody2" id="PageBody2" class="summernote2"></textarea>

                    <!-- / محتوى الصفحة -->


                    <button type="submit" class="btn btn-primary btn-block"><i
                            class="ti-save"></i> حفظ
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- نهاية مودال تعديل الصفحة -->


<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>