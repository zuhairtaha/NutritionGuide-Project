<?php

$o=$options[0];


?>
<form action="<?=base_url()?>control/update_settings" method="post" class="form" accept-charset="utf-8" >
    <div class="form-group">
        <label for="siteName"><i class="ti-text"></i> اسم الموقع</label>
        <input type="text" placeholder="اسم الموقع" name="siteName" id="siteName" class="form-control" value="<?=$o->site_name?>" />
    </div>

    <div class="form-group">
        <label for="siteDesc"><i class="ti-align-right"></i> وصف الموقع</label>
        <input type="text" placeholder="وصف الموقع" name="siteDesc" id="siteDesc" class="form-control" value="<?=$o->site_description?>" />
    </div>

    <div class="form-group">
        <label for="facebook"><i class="ti-facebook"></i> فيسبوك</label>
        <input type="text" placeholder="فيسبوك" name="facebook" id="facebook" class="form-control" value="<?=$o->facebook?>" />
    </div>

    <div class="form-group">
        <label for="twitter"><i class="ti-twitter"></i> تويتر</label>
        <input type="text" placeholder="تويتر" name="twitter" id="twitter" class="form-control" value="<?=$o->twitter?>" />
    </div>

    <div class="form-group">
        <label for="youtube"><i class="ti-youtube"></i> يوتيوب</label>
        <input type="text" placeholder="يوتيوب" name="youtube" id="youtube" class="form-control" value="<?=$o->youtube?>" />
    </div>



    <button class="btn btn-success btn-block" type="submit"><i class="ti-save" id="submit" name="submit"></i> حفظ</button>


</form>