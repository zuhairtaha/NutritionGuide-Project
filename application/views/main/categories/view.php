<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a></li>
    <li><a href="<?= base_url() ?>categories"><i class="fa fa-cutlery"></i> التصنيفات الغذائية</a></li>
    <li><a href="<?= base_url() ?>category/<?= $id ?>"> <?= $food_stuffs[0]->fc_title ?></a></li>
</ol>
<div class="row">
    <? foreach ($food_stuffs as $food_stuff): ?>


        <div class="col-lg-3 col-md-3 col-sm-6 ">
            <div class="thumbnail">
                <a href="<?= base_url() ?>food/<?= $food_stuff->f_id ?>">
                    <img class="img-rounded" src="<?= base_url() ?>assets/uploads/thumb_<?= $food_stuff->f_image ?>"
                         alt="<?= $food_stuff->f_title ?>">
                </a>

                <div class="caption">

                    <a class="btn btn-block btn-default"
                       href="<?= base_url() ?>food/<?= $food_stuff->f_id ?>"><?= $food_stuff->f_title ?></a>

                </div>
            </div>
        </div>
    <? endforeach; ?>

</div>