<form role="form" id="addcategories" action="<?= base_url() ?>control/add_food_stuff" method="post">


    <div class="form-group col-sm-12">
        <label for="f_title"><i class="ti-apple"></i> المادة الغذائية</label>
        <input type="text" class="form-control col-md-12" id="f_title" name="f_title"
               placeholder="المادة الغذائية"/>
    </div>

    <div class="form-group col-sm-6">
        <label for="f_category_id"><i class="fa fa-cutlery"></i> التصنيف</label>
        <select class="form-control col-md-12" name="f_category_id" id="f_category_id">
            <? $c = 0;
            foreach ($food_categories as $f) {
                ?>
                <option <? if ($c == 0) echo 'selected="selected"'; ?>
                    value="<?= $f->fc_id ?>"><?= $f->fc_title ?></option>
                <?
                $c++;
            } ?>

        </select>
    </div>


    <div class="form-group col-sm-6">
        <label for="f_size"><i class="ti-control-backward"></i> الحجم (تقريبي)</label>
        <input type="text" class="form-control col-md-12" id=f_size" name="f_size"
               placeholder="الحجم (تقريبي)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_weight"><i class="ti-control-backward"></i> الوزن (غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_weight" name="f_weight"
               placeholder="الوزن (غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_calories"><i class="ti-control-backward"></i> السعرات الحرارية (kcal)</label>
        <input type="text" class="form-control col-md-12" id="f_calories" name="f_calories"
               placeholder="السعرات الحرارية (kcal)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_proteins"><i class="ti-control-backward"></i> البروتينات (غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_proteins" name="f_proteins"
               placeholder="البروتينات (غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_fats"><i class="ti-control-backward"></i> الدهون (غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_fats" name="f_fats"
               placeholder="الدهون (غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_carbohydrates"><i class="ti-control-backward"></i> الكربوهيدرات (غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_carbohydrates"
               name="f_carbohydrates" placeholder="الكربوهيدرات (غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_bast"><i class="ti-control-backward"></i> الألياف (غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_bast" name="f_bast"
               placeholder="الألياف (غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_cholesterol"><i class="ti-control-backward"></i> الكوليسترول (ميلي غرام) </label>
        <input type="text" class="form-control col-md-12" id="f_cholesterol" name="f_cholesterol"
               placeholder="الكوليسترول (ميلي غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_calcium"><i class="ti-control-backward"></i> الكالسيوم (ميلي غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_calcium" name="f_calcium"
               placeholder="الكالسيوم (ميلي غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_iron"><i class="ti-control-backward"></i> الحديد (ميلي غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_iron" name="f_iron"
               placeholder="الحديد (ميلي غرام)"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="f_sodium"><i class="ti-control-backward"></i> الصوديوم (ميلي غرام)</label>
        <input type="text" class="form-control col-md-12" id="f_sodium" name="f_sodium"
               placeholder="الصوديوم (ميلي غرام)"/>
    </div>


    <!-- upload -->
    <div id="imagesUploded" class="row"></div>
    <div class="row" id="uploadedImagesRow"></div>
    <input type="hidden" name="imagesUpNames" id="imagesUpNames"/>

    <div>
        <div class="uploadImgs"></div>
    </div>


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
<style type="text/css">
    #checkBoxStampSpan {
        display: none;
    }
</style>