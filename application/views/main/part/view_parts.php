<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a></li>
            <li><a href="<?= current_url() ?>"><i class="fa fa-list"></i> أقسام الموقع</a>
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <? foreach ($parts as $p): ?>

        <div class="col-sm-6 col-md-4 part_view_div">
            <div class="thumbnail">
                <a href="<?= base_url() ?>part/<?= $p->part_id ?>">
                    <img src="<?= base_url() ?>assets/uploads/thumb_<?= $p->part_image ?>" alt="<?= $p->part_title ?>">
                </a>

                <div class="caption">
                    <h3>
                        <a href="<?= base_url() ?>part/<?= $p->part_id ?>">
                            <?= $p->part_title ?>
                        </a>
                    </h3>

                    <p class="align-justify"><?= $p->part_description ?></p>

                    <p><i class="fa fa-pencil-square-o"></i>
                        آخر مقال:
                        <a href="<?= base_url() . $p->last_post_id ?>"><?= $p->last_post_title ?></a>
                    </p>

                    <p><i class="fa fa-user"></i>
                        بواسطة:
                        <a href="<?= base_url() ?>user/<?= $p->last_post_author_id ?>"><?= $p->last_post_author_name ?></a>

                        <span class="gray_color">, <i class="ti-time"></i>
                <time class="timeago" datetime="<?= $p->last_post_date ?>"><?= $p->last_post_date ?></time>
            </span>


                    </p>

                    <p>
                        <a href="#" class="btn btn-primary" role="button"><i class="fa fa-list"></i>
                            عرض القسم</a>
                        <a href="#" class="btn btn-default" role="button"><i class="fa fa-file"></i>
                            فتح آخر مقال</a>
                    </p>
                </div>
            </div>
        </div>

    <? endforeach; ?>
</div>

