<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 01/05/2016
 * Time: 09:40 م
 */
function highlight($c, $q)
{
    $q = explode(' ', $q);
    for ($i = 0; $i < sizeOf($q); $i++)
        $c = preg_replace("/($q[$i])/i", "<span class=\"highlight\">\${1}</span>", $c);
    return $c;
}

?>
<!-- إضافة جي كويري لعرض التاريخ بصيغة (منذ ... مضت) -->
<script src="<?= base_url() ?>assets/js/jquery.timeago.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.timeago.ar.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("time.timeago").timeago();
    });
</script>


<div class="row">

    <?
    foreach ($posts as $p):
        $content = $p->post_content;
        ?>

        <div class="col-lg-6">
            <div class="media margin-bottom-1">
                <div class="media-left">

                    <!-- الصورة كرابط -->
                    <a href="<?= base_url() . $p->post_id ?>">
                        <img class="media-object img-size-128"
                             src="<?
                             if (get_first_image_if_exist($content)) echo get_first_image_if_exist($content);
                             else echo base_url() . "assets/uploads/thumb_" . $p->part_image;
                             ?>"
                             alt="<?= $p->post_title ?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">

                        <!-- العنوان -->
                        <a href="<?= base_url() . $p->post_id ?>"><i class="ti-pencil-alt"></i> <?= highlight($p->post_title,$key) ?>
                        </a>
                    </h4>

                    <!-- أول x كلمة من نص المقال -->
                    <span class="two-lines"> <?= highlight(get_words($content, 100),$key) ?> </span>

                    <!-- الكاتب -->
                    <p class="gray_color">
                        <i class="ti-user"></i> <?= $p->user_name ?>, <i class="ti-calendar"></i>
                        <time class="timeago" datetime="<?= $p->post_date ?>"><?= $p->post_date ?></time>
                        , <i class="ti-eye"></i> <?= $p->post_visits ?>
                    </p>


                </div>
            </div>
        </div>
    <? endforeach; ?>

</div>

<div class="row">
    <div class="col-lg-12">
        <? //= $this->pagination->create_links() ?>
    </div>
</div>
