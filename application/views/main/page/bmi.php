<!-- http://genesis-fertility.com/tag/wellness-wednesdays/ -->
<!-- http://www.lubseymedical.com/obesity.htm -->
<!-- حساب الوضع الصحي -->
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> الرئيسة</a></li>
            <li><a href="<?= current_url() ?>"><i class="fa fa-file-text-o"></i> الوضع الصحي</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-9">

        <p>
            حساب الوزن المثالى عن مؤشر " كتلة الجسم " أو " BMI " من خلال حساب كتلة الجسم لمعرفة ما إذا كان الوزن ضمن
            المعدل الصحي أم يجب خسارة بعض الوزن أو زيادة بعض الوزن.
        </p>

        <form id="MBI_form" class="form">

            <!-- العمر
            <div class="form-group col-sm-6">
                <label for="age">العمر</label>
                <input type="number" value="32" class="form-control" id="age" name="age" placeholder="كم عمرك؟">
            </div>
            -->

            <!-- الطول -->
            <div class="form-group">
                <label for="height">الطول (سم)</label>
                <input type="number" value="180" class="form-control" id="height" name="height"
                       placeholder="ماهو طولك (سم) ؟">
            </div>

            <!-- الجنس
            <div class="form-group col-sm-6">
                <label for="gender">الجنس</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
            </div>
            -->

            <!-- الوزن -->
            <div class="form-group">
                <label for="mass">الوزن (كغ)</label>
                <input type="number" value="72" class="form-control" id="mass" name="mass" placeholder="وزنك (كغ) ؟">
            </div>

            <button type="submit" class="btn btn-info"><i class="fa fa-calculator"></i> احسب</button>

        </form>
        <br/>
        <p id="mbiSpan"></p>
        <p id="mbi_result"></p>

    </div>
    <div class="col-md-3">
        <img id="img_status" class="img-responsive" style="display: none" src=""/>

    </div>


</div>



