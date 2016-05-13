<div class="row">
    <div class="container">
        <h3>
            <i class="ti-alert"></i>

            <?= $error ?>
        </h3>
        <p>يمكنك التوجه إلى الصفحة الرئيسة أو استعمال ميزة البحث</p>
        <p>
            <? if (!empty($_SERVER["HTTP_REFERER"])) { ?>
                <a href="<?= $_SERVER["HTTP_REFERER"] ?>" class="btn btn-link"><i class="fa fa-backward"></i> العودة إلى
                    حيث كنت</a>
            <? } ?>
        </p>
    </div>
</div>