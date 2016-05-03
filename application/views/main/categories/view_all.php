<div class="row">
    <div class="col-lg-12">

        <? $c = 1;
        foreach ($categories as $category): ?>
            <div class="col-lg-4">
                <div class="thumbnail">
                    <a href="<?= base_url() ?>category/<?= $category->fc_id ?>">
                        <img src="<?= base_url() ?>assets/uploads/thumb_<?= $category->fc_image ?>"
                             alt="<?= $category->fc_title ?>"/>
                    </a>

                    <div class="caption">
                        <?
                        if ($c == 1 || $c == 7) $w = "primary";
                        if ($c == 2 || $c == 8) $w = "warning";
                        if ($c == 3 || $c == 9) $w = "danger";
                        if ($c == 4 || $c == 10) $w = "info";
                        if ($c == 5 || $c == 11) $w = "success";
                        if ($c == 6 || $c == 12) $w = "default";
                        ?>
                        <a class="btn btn-<?= $w ?> btn-block"
                           href="<?= base_url() ?>category/<?= $category->fc_id ?>"><?= $category->fc_title ?>
                            <span class="badge"><?=$category->num_foods?></span> </a>

                    </div>
                </div>

            </div>
            <? $c++; endforeach; ?>

    </div>
</div>