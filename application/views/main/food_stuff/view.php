<ol class="breadcrumb">
    <li>
        <a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a>
    </li>
    <li>
        <a href="<?= base_url() ?>categories"><i class="fa fa-cutlery"></i> التصنيفات الغذائية</a>
    </li>
    <li>
        <a href="<?= base_url() ?>category/<?= $food_stuff[0]->f_category_id ?>"> <?= $food_stuff[0]->fc_title ?></a>
    </li>
    <li>
        <a href="<?= base_url() ?>food/<?= $food_stuff[0]->f_id ?>"> <?= $food_stuff[0]->f_title ?></a>
    </li>
</ol>
<? $f = $food_stuff[0]; ?>
<div class="row">

    <div class="col-lg-4">

        <table class="table" role="table">
            <tr>
                <td class="no-border-top" colspan="2">
                    <!-- <img class="img-responsive" src="<?= base_url() ?>assets/uploads/<?= $f->f_image ?>"/> -->
                </td>
            </tr>
            <tr>
                <td><i class="ti-check-box"></i> الحجم (تقريبي)</td>
                <td><span class="badge"><?= $f->f_size ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الوزن (غرام)</td>
                <td><span class="badge"><?= $f->f_weight ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> السعرات الحرارية (kcal)</td>
                <td><span class="badge"><?= $f->f_calories ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> البروتينات (غرام)</td>
                <td><span class="badge"><?= $f->f_proteins ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الدهون (غرام)</td>
                <td><span class="badge"><?= $f->f_fats ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الألياف (غرام)</td>
                <td><span class="badge"><?= $f->f_bast ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الكربوهيدرات (غرام)</td>
                <td><span class="badge"><?= $f->f_carbohydrates ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الكوليسترول (ميلي غرام)</td>
                <td><span class="badge"><?= $f->f_cholesterol ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الكالسيوم (ميلي غرام)</td>
                <td><span class="badge"><?= $f->f_calcium ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الحديد (ميلي غرام)</td>
                <td><span class="badge"><?= $f->f_iron ?></span></td>

            <tr>
                <td><i class="ti-check-box"></i> الصوديوم (ميلي غرام)</td>
                <td><span class="badge"><?= $f->f_sodium ?></span></td>
            </tr>
        </table>
    </div>


    <div class="col-lg-8">
        <img class="img-responsive" src="<?= base_url() ?>assets/uploads/<?= $f->f_image ?>"/>
    </div>


</div>