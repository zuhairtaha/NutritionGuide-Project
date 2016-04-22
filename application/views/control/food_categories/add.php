<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 20/04/2016
 * Time: 12:30 م
 */
?>
<script src="<?= base_url() ?>assets/js/myscript.js"></script>

<form class="form" method="post" action="<?= base_url() ?>control/insert_food_category" accept-charset="utf-8">
<div class="form-group">
        <label for="fc_level"><i class="ti-exchange-vertical"></i> الترتيب</label>
        <input type="text" placeholder="الترتيب" name="fc_level" id="fc_level" class="form-control" value="" />
    </div>

    <div class="form-group">
        <label for="fc_title"><i class="ti-file"></i> العنوان</label>
        <input type="text" placeholder="العنوان" name="fc_title" id="fc_title" class="form-control" value="" />
    </div>

    <div class="form-group">
        <label for="fc_description"><i class="ti-write"></i> الوصف</label>
        <input type="text" placeholder="الوصف" name="fc_description" id="fc_description" class="form-control" value="" />
    </div>
<!--
    <div class="form-group">
        <label for="fc_image"><i class="ti-image"></i> الصورة</label>
        <input type="file" placeholder="الصورة" name="fc_image" id="fc_image" value="" />
    </div>
-->

    <button class="btn btn-success"><i class="ti-save"></i> حفظ</button>
</form>





