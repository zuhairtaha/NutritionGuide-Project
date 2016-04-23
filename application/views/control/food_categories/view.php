<!-- upload form -------------- -->
<form class="hide" action="<?= base_url() ?>upload/uploadMultiImgs" id="imgsUpForm"
      method="post" accept-charset="utf-8">
    <input type="file" name="file[]" id="file" accept="image/*"/>

    <p class="btn btn-primary" id="upMultiImgsBtn"></p>
</form> <!-- /upload form -->

<div class="row">
    <div class="col-lg-12">
        <!-- زر أضف تصنيف جديد -->
        <p class="btn btn-primary" id="fcModalBtn"><i class="glyphicon glyphicon-plus"></i> إضافة تصنيف جديد </p>
    </div>
</div>

<!-- مودال إضافة تصنيف -->
<div id="fcModal" class="modal fade categoriesModal-md" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header margin-bottom-0 alert alert-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 id="fcModalTitle" class="modal-title"></h4>
            </div>
            <div class="modal-body padding-1em" id="fcModalContent">


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- نهاية مودال إضافة تصنيف -->

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>الترتيب</th>
        <th>العنوان</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($food_categories as $fc): ?>
        <tr>
            <!-- الرقم التسلسلي -->
            <td><?= $fc->fc_id ?></td>
            <!-- الترتيب -->
            <td><?= $fc->fc_level ?></td>
            <!-- العنوان -->
            <td><a target="_blank" href="<?= base_url() ?>n-<?= $fc->fc_id ?>">
                    <!-- الصورة -->
                    <img class="img-rounded" style="width:1.5em"
                         src="<?= base_url("assets/uploads/thumb_" . $fc->fc_image) ?>" alt=""/>
                    <?= $fc->fc_title ?></a></td>
            <td>
                <!-- زر حذف تصنيف -->
                <a class="btn btn-danger btn-xs deleteCategory"
                   href="<?= base_url() ?>control/delete_food_category/<?= $fc->fc_id ?>"><i
                        class="glyphicon glyphicon-trash"></i></a>
                <!-- زر تعديل تصنيف -->
                <button data-title="<?= $fc->fc_title ?>"
                        data-level="<?= $fc->fc_level ?>"
                        data-id="<?= $fc->fc_id ?>"
                        data-img="<?= $fc->fc_image ?>"
                        class="btn btn-xs btn-warning editCategories">
                    <i class="ti-pencil-alt"></i>
                </button>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>

<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>