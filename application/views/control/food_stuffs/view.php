<!-- upload form -------------- -->
<form class="hide" action="<?= base_url() ?>upload/uploadMultiImgs" id="imgsUpForm"
      method="post" accept-charset="utf-8">
    <input type="file" name="file[]" id="file" accept="image/*"/>

    <p class="btn btn-primary" id="upMultiImgsBtn"></p>
</form> <!-- /upload form -->

<div class="row">
    <div class="col-lg-12">
        <!-- زر أضف مادة غذائية جديدة -->
        <p class="btn btn-primary" id="fsModalBtn"><i class="glyphicon glyphicon-plus"></i> إضافة مادة غذائية جديدة </p>
    </div>
</div>

<!-- مودال إضافة مادة غذائية -->
<div id="fsModal" class="modal fade categoriesModal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header margin-bottom-0 alert alert-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 id="fsModalTitle" class="modal-title"></h4>
            </div>
            <div class="modal-body padding-1em" id="fsModalContent">


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- نهاية مودال إضافة مادة غذائية -->

<table class="table">
    <thead>
    <tr>
        <th class="col-xs-1">#</th>
        <th>المادة الغذائية</th>
        <th>التصنيف</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($food_categories as $f): ?>
        <tr>
            <td><?= $f->f_id ?> </td>
            <td>
                <img class="img-rounded" style="width:1.5em"
                src="<?= base_url("assets/uploads/thumb_" . $f->f_image) ?>" alt=""/> <?= $f->f_title ?>

                <span data-toggle="collapse" data-target="#details-<?= $f->f_id ?>"
                      class="btn btn-xs btn-default show_hide_food_stuff_details">
                    &nbsp;<i class=ti-more-alt></i>&nbsp;</span>

                <ul id="details-<?= $f->f_id ?>" class="food_stuff_details collapse">
                    <li>الحجم (تقريبي)
                        <span class="badge"><?= $f->f_size ?></span>
                    </li>
                    <li>الوزن (غرام)
                        <span class="badge"><?= $f->f_weight ?></span>
                    </li>
                    <li>السعرات الحرارية (kcal)
                        <span class="badge"><?= $f->f_calories ?></span>
                    </li>
                    <li>البروتينات (غرام)
                        <span class="badge"><?= $f->f_proteins ?></span>
                    </li>
                    <li>الدهون (غرام)
                        <span class="badge"><?= $f->f_fats ?></span>
                    </li>
                    <li>الألياف (غرام)
                        <span class="badge"><?= $f->f_bast ?></span>
                    </li>
                    <li>الكربوهيدرات (غرام)
                        <span class="badge"><?= $f->f_carbohydrates ?></span>
                    </li>
                    <li>الكوليسترول (ميلي غرام)
                        <span class="badge"><?= $f->f_cholesterol ?></span>
                    </li>
                    <li>الكالسيوم (ميلي غرام)
                        <span class="badge"><?= $f->f_calcium ?></span>
                    </li>
                    <li>الحديد (ميلي غرام)
                        <span class="badge"><?= $f->f_iron ?></span>
                    </li>
                    <li>الصوديوم (ميلي غرام)
                        <span class="badge"><?= $f->f_sodium ?></span>
                    </li>
                </ul>
            </td>
            <td><?= $f->fc_title ?></td>
            <td>
                <!-- زر حذف تصنيف -->
                <a class="btn btn-danger btn-xs deleteStuff"
                   href="<?= base_url() ?>control/delete_food_stuff/<?= $f->f_id ?>"><i
                        class="glyphicon glyphicon-trash"></i></a>
                <!-- زر تعديل تصنيف -->
                <a href="<?= base_url() ?>control/edit_food_stuff/<?= $f->f_id ?>" data-title="<?= $f->f_title ?>"
                   data-id="<?= $f->f_id ?>"
                   data-img="<?= $f->f_image ?>"
                   class="btn btn-xs btn-warning edit_food_stuff">
                    <i class="ti-pencil-alt"></i>
                </a>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>

<?= $this->pagination->create_links() ?>
<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>