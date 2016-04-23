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
        <div class="uploadImgs"></div>
    </div>

    <input type="hidden" name="author_id" value="1"/>
    <!-- /upload -->


    <button type="submit" class="btn btn-primary btn-block"><i
            class="ti-save"></i> حفظ
    </button>
</form>
<script>
    $(document).ready(function () {
        $(".uploadImgs").html('<h1><i class="glyphicon glyphicon-refresh spinner"></i></h1>').load(base_url + 'upload/up1');
    });

</script>