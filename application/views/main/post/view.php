<? $p = $post[0]; ?>

<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a></li>
    <li><a href="<?= base_url() ?>parts"><i class="ti-view-list"></i> أقسام الموقع</a></li>
    <li><a href="<?= base_url() ?>part/<?= $p->part_id ?>"><?= $p->part_title ?></a></li>
    <li><a href="<?= base_url() ?><?= $p->post_id ?>"> <?= $p->post_title ?></a></li>
</ol>

<div class="row">
    <div class="container">
        <h3><?= $p->post_title ?></h3>

        <p><?= $p->post_content ?></p>

        <p class="gray_color">
            <i class="ti-user"></i> <?= $p->user_name ?>, <i class="ti-calendar"></i>
            <time class="timeago" datetime="<?= $p->post_date ?>"><?= $p->post_date ?></time>
            , <i class="ti-eye"></i> <?= $p->post_visits ?>
        </p>


    </div>
</div>