<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 01/05/2016
 * Time: 11:59 م
 */
?>

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