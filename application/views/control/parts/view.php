<!-- upload form -------------- -->
<form class="hide" action="<?= base_url() ?>upload/uploadMultiImgs" id="imgsUpForm"
      method="post" accept-charset="utf-8">
    <input type="file" name="file[]" id="file" accept="image/*"/>

    <p class="btn btn-primary" id="upMultiImgsBtn"></p>
</form> <!-- /upload form -->

<div class="row">
    <div class="col-lg-12">
        <!-- زر أضف قسم جديد -->
        <p class="btn btn-primary" id="partModalBtn"><i class="glyphicon glyphicon-plus"></i> إضافة قسم جديد </p>
    </div>
</div>

<!-- مودال إضافة قسم -->
<div id="partModal" class="modal fade partModal-md" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header margin-bottom-0 alert alert-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 id="partModalTitle" class="modal-title"></h4>
            </div>
            <div class="modal-body padding-1em" id="partModalContent">


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- نهاية مودال إضافة قسم -->

<table class="table table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>الترتيب</th>
        <th>العنوان</th>

        <th style="width:5em">التحكم</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($parts as $p): ?>
        <tr>
            <!-- الرقم التسلسلي -->
            <td><?= $p->part_id ?></td>

            <!-- الترتيب -->
            <td><?= $p->part_level ?></td>

            <!-- العنوان -->
            <td>

                <div class="media">
                    <div class="media-right">
                        <img class="media-object parts_images_cp"
                             src="<?= base_url("assets/uploads/thumb_" . $p->part_image) ?>" alt="...">
                    </div>
                    <div class="media-body">
                        <a target="_blank" href="<?= base_url() ?>part/<?= $p->part_id ?>">
                            <h4 class="media-heading"><?= $p->part_title ?></h4>
                        </a>
                        <?= $p->part_description ?>
                    </div>
                </div>
            </td>

            <!-- الوصف -->


            <!-- التحكم -->
            <td>
                <!-- زر حذف قسم -->
                <a class="btn btn-danger btn-xs deletePart"
                   href="<?= base_url() ?>control/delete_part/<?= $p->part_id ?>"><i
                        class="glyphicon glyphicon-trash"></i></a>

                <!-- زر تعديل قسم -->
                <button data-title="<?= $p->part_title ?>"
                        data-level="<?= $p->part_level ?>"
                        data-id="<?= $p->part_id ?>"
                        data-img="<?= $p->part_image ?>"
                        data-desc="<?= $p->part_description ?>"
                        class="btn btn-xs btn-warning editPart">
                    <i class="ti-pencil-alt"></i>
                </button>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>

<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>