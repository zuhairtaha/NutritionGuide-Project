<!-- إضافة جي كويري لعرض التاريخ بصيغة (منذ ... مضت) -->
<script src="<?= base_url() ?>assets/js/jquery.timeago.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.timeago.ar.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("time.timeago").timeago();
    });
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a></li>
    <li><a href="<?= base_url() ?>parts"><i class="ti-view-list"></i> أقسام الموقع</a></li>
    <li><a href="<?= base_url() ?>part/<?= $posts[0]->post_part_id ?>"> <?= $posts[0]->part_title ?></a></li>
</ol>
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
                             else echo base_url()."assets/uploads/thumb_".$p->part_image;
                             ?>"
                             alt="<?= $p->post_title ?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">

                        <!-- العنوان -->
                        <a href="<?= base_url() . $p->post_id ?>"><i clas="ti-pencil-alt"></i> <?= $p->post_title ?>
                        </a>
                    </h4>

                    <!-- أول x كلمة من نص المقال -->
                    <span class="two-lines"> <?= get_words($content, 100) ?> </span>

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
        <?= $this->pagination->create_links() ?>
    </div>
</div>