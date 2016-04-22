<!-- upload form -------------- -->
<form class="hide" action="<?= base_url() ?>upload/uploadMultiImgs" id="imgsUpForm"
      method="post" accept-charset="utf-8">
    <input type="file" name="file[]" id="file" accept="image/*"/>

    <p class="btn btn-primary" id="upMultiImgsBtn"></p>
</form> <!-- /upload form -->

<div class="row">
    <div class="col-lg-12">
        <p class="btn btn-primary" data-toggle="modal" data-target=".categoriesModal-md">
            <i class="glyphicon glyphicon-plus"></i>
            إضافة تصنيف جديد
        </p>
    </div>
</div>


<!-- مودال إضافة تصنيف -->
<div class="modal fade categoriesModal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div style="margin-bottom: 0;" class="modal-header alert alert-warning">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 id="myLargeModalLabel" class="modal-title"><i class="glyphicon glyphicon-plus"></i> إضافة تصنيف جديد
                </h4></div>
            <div style="padding: 1em;">
                <form role="form" id="addcategories" action="<?= base_url() ?>control/add_food_category" method="post">
                    <div class="row titleAndLevel">
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-md-12" id="title" name="title"
                                   placeholder="عنوان التصنيف"/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-md-12" id="categoryLevel" name="categoryLevel"
                                   placeholder="الترتيب"/>
                        </div>
                    </div>


                    <!-- upload -->
                    <div id="imagesUploded" class="row"></div>
                    <div class="row" id="uploadedImagesRow"></div>
                    <input type="hidden" name="imagesUpNames" id="imagesUpNames"/>

                    <div>
                        <div id="uploadImgs"></div>
                    </div>

                    <input type="hidden" name="author_id" value="1"/>
                    <!-- /upload -->


                    <button type="submit" class="btn btn-primary btn-block"><i
                            class="ti-save"></i> حفظ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
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
            <td><?= $fc->fc_id ?></td>
            <td><?= $fc->fc_level ?></td>
            <td><a target="_blank" href="<?= base_url() ?>n-<?= $fc->fc_id ?>">
                    <img class="img-rounded" style="width:1.5em"
                         src="<?= base_url("assets/uploads/thumb_" . $fc->fc_image) ?>" alt=""/>
                    <?= $fc->fc_title ?></a></td>

            <td>
                <a class="btn btn-danger btn-xs deleteCategory"
                   href="<?= base_url() ?>control/delete_food_category/<?= $fc->fc_id ?>"><i
                        class="glyphicon glyphicon-trash"></i></a>
                <button data-title="<?= $fc->fc_title ?>"
                        data-level="<?= $fc->fc_level ?>"
                        data-id="<?= $fc->fc_id ?>"
                        data-img="<?= $fc->fc_image ?>"
                        class="btn btn-xs btn-warning editCategories"
                        data-toggle="modal" data-target=".EdtcategoriesModal-md"><i class="ti-pencil-alt"></i>
                </button>
            </td>


        </tr>
    <? endforeach; ?>
    </tbody>
</table>


<!-- بداية مودال تعديل التصنيف -->
<div class="modal fade EdtcategoriesModal-md editcategoriesDivModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabeEdt">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div style="margin-bottom: 0;" class="modal-header alert alert-warning">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 id="myLargeModalLabeEdt" class="modal-title"><i class="ti-pencil-alt"></i> تعديل تصنيف
                </h4></div>
            <div id="postEditContnt" style="padding: 1em;">
                <!-- المحتوى  -->
                <form role="form" id="editCategoryForm" action="<?= base_url() ?>control/update_food_category"
                      method="post">
                    <div class="row titleAndLevel">
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-md-12" id="categoryTitleEdt"
                                   name="categoryTitleEdt"
                                   placeholder="عنوان التصنيف"/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-md-12" id="categoryLevelEdit"
                                   name="categoryLevelEdit"
                                   placeholder="الترتيب"/>
                        </div>
                    </div>


                    <!-- upload -->
                    <div id="imagesUploded" class="row"></div>

                    <div id="uploadedImagesRow" class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail"><img id="categoryImgEdit" src="">

                                <div class="caption"><span id="spanDeleteImg" data-img=""
                                                           class="deleteUploadedImage btn btn-danger btn-xs btn-block"
                                                           role="button"><i
                                            class="glyphicon glyphicon-trash"></i> حذف</span></div>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="imagesUpNamesEdt" id="imagesUpNamesEdt"/>

                    <div>
                        <div id="uploadImgs"></div>
                    </div>

                    <input type="hidden" name="author_id" value="1"/>
                    <input type="hidden" id="categoryIdEdit" name="categoryIdEdit" value="1"/>
                    <!-- /upload -->


                    <button type="submit" class="btn btn-primary btn-block"><i
                            class="ti-save"></i> حفظ
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- نهاية مودال تعديل التصنيف -->


<script src="<?= base_url() . 'assets/js/' ?>upImgs.js"></script>