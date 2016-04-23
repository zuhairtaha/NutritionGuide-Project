<form role="form" id="addcategories" action="<?= base_url() ?>control/update_food_category/<?= $id ?>" method="post">
    <div class="row titleAndLevel">
        <div class="col-sm-6">
            <input type="text" class="form-control col-md-12" id="title" name="title" value="<?= $title ?>"
                   placeholder="عنوان التصنيف"/>
        </div>
        <div class="col-sm-6">
            <input type="text" class="form-control col-md-12" id="categoryLevel" name="categoryLevel"
                   value="<?= $level ?>"
                   placeholder="الترتيب"/>
        </div>
    </div>

    <!-- upload -->
    <div id="imagesUploded" class="row"></div>


    <div id="uploadedImagesRow" class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail"><img src="<?=base_url()?>assets/uploads/thumb_<?=$img?>">

                <div class="caption"><span data-img="<?=$img?>" class="btn btn-danger btn-xs btn-block"
                                           onclick="delMySelf()" id="deleteUploadedImage" role="button"><i
                            class="glyphicon glyphicon-trash"></i> حذف</span></div>
            </div>
        </div>
    </div>

    <input type="hidden" name="imagesUpNames" id="imagesUpNames"/>

    <div>
        <div class="uploadImgs"></div>
    </div>

    <input type="hidden" name="author_id" value="<?=$this->session->user_id?>"/>
    <!-- /upload -->


    <button type="submit" class="btn btn-primary btn-block">
        <i class="ti-save"></i> حفظ
    </button>
</form>
<script>
    $(document).ready(function () {
        $(".uploadImgs").html('<h1><i class="glyphicon glyphicon-refresh spinner"></i></h1>').load(base_url + 'upload/up1').hide();

    });

</script>