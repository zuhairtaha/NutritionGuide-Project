<!-- المصدر: http://halls.md/body-mass-index/av.htm -->
<script src="<?= base_url() ?>assets/js/mbi.min.js"></script>
<form action="" method="POST">
    <!-- الوزن -->
    <div class="row">

        <!-- الوزن -->
        <div class="col-md-3 col-sm-6">
            <div class="form-group">
                <label for="wt"><i class="ti-harddrive"></i> الوزن</label>
                <input type="text" placeholder="الوزن" name="wt" id="wt" class="form-control" value="">
            </div>
        </div>

        <!-- وحدة قياس الوزن -->
        <div class="col-md-3 col-sm-6">
            <div class="form-group">
                <label for="wu"> وحدة قياس الوزن</label>
                <select class="form-control" onchange="poundsAndKilos(this.form)" id="wu" name="wu">
                    <option>رطل (باوند)</option>
                    <option selected="selected">كغ</option>
                </select>
            </div>
        </div>

        <!-- العمر -->
        <div class="col-md-3 col-sm-6">

            <div class="form-group">
                <label for="Years"><i class="ti-id-badge"></i> العمر </label>
                <input type="text" placeholder="العمر (تحديد السنوات بالضبط)" name="Years" id="Years"
                       class="form-control" value="">
            </div>
        </div>

        <!-- الفئة العمرية -->
        <div class="col-md-3 col-sm-6">
            <div class="form-group">
                <label for="AgeCat"> أو الفئة العمرية</label>
                <select class="form-control" onchange="SetAge(this.form)" name="AgeCat" id="AgeCat">
                    <option>70 + أكثر من</option>
                    <option>60 - 69 سنةسنة</option>
                    <option>50 - 59 سنة</option>
                    <option>40 - 49 سنة</option>
                    <option>30 - 39 سنة</option>
                    <option>20 - 29 سنة</option>
                    <option>18 - 19 سنة</option>
                    <option>17 سنة</option>
                    <option>16 سنة</option>
                    <option>15 سنة</option>
                    <option>14 سنة</option>
                    <option>13 سنة</option>
                    <option>12 سنة</option>
                    <option>11 سنة</option>
                    <option>10 سنة</option>
                    <option>9 سنة</option>
                    <option>8 سنة</option>
                    <option>7 سنة</option>
                    <option>6 سنة</option>
                    <option>5 سنة</option>
                    <option>4 سنة</option>
                    <option>3 سنة</option>
                    <option>2 سنة</option>
                    <option>1.5 سنة</option>
                    <option>1 سنة</option>
                    <option selected="">بالغ</option>
                    <option>طفل</option>
                </select>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- الطول -->
        <div class="col-md-3 col-sm-6">
            <div class="form-group">
                <label for="ht"><i class="ti-ruler-alt"></i> الطول</label>
                <input type="text" placeholder="الطول" name="ht" id="ht" class="form-control" value="">
            </div>
        </div>

        <!-- وحدة قياس الطول -->
        <div class="col-md-3 col-sm-6">
            <div class="form-group">
                <label for="hu"> وحدة قياس الطول</label>
                <select class="form-control" onchange="inchesCm(this.form)" name="hu" id="hu">
                    <option>بوصة (إنش)</option>
                    <option selected="selected">سم</option>
                </select>
            </div>
        </div>

        <!-- الأطوال بالقدم والبوصة (مخفي) -->
        <div class="hide">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="htf"> قدم</label>
                    <select class="form-control" onchange="feetAndInches(this.form)" name="htf" id="htf">
                        <option value="1">1'</option>
                        <option value="2">2'</option>
                        <option value="3">3'</option>
                        <option value="4">4'</option>
                        <option selected="" value="5">5'</option>
                        <option value="6">6'</option>
                        <option value="7">7'</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="hti"> بوصة (إنش) </label>
                    <select class="form-control" onchange="feetAndInches(this.form)" name="hti" id="hti">
                        <option value="0">0''</option>
                        <option value="1">1''</option>
                        <option value="2">2''</option>
                        <option value="3">3''</option>
                        <option value="4">4''</option>
                        <option value="5">5''</option>
                        <option selected="" value="6">6''</option>
                        <option value="7">7''</option>
                        <option value="8">8''</option>
                        <option value="9">9''</option>
                        <option value="10">10''</option>
                        <option value="11">11''</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- الجنس -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="Gender"><i class="fa fa-mars"></i> الجنس</label>
                <select class="form-control" onchange="CalcIt(this.form)" name="Gender" id="Gender">
                    <option selected="">ذكر</option>
                    <option>أنثى</option>
                </select>
            </div>
        </div>

    </div>

    <!-- حساب مؤشر كتلة الجسم -->
    <div class="row">
        <!-- زر الحساب -->
        <div class="col-md-12">
            <input type="button" class="btn btn-success btn-md" name="button" onclick="CalcIt(this.form)"
                   value="حساب مؤشر كتلة الجسم ومعرفة الوضع الصحي"/>
            <br/>
        </div>
    </div>

    <!-- النتائج -->
    <div class="row">

        <!-- الوضع الصحي -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="interp"> الوضع الصحي (حالة جسمك)</label>
                <input type="text" placeholder="الوضع الصحي (حالة جسمك)" name="interp" id="interp" class="form-control"
                       value="">
            </div>
        </div>

        <!-- مؤشر كتلة الجسم -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="bmi">&nbsp; مؤشر كتلة الجسم كغ\م<sup>
                        <small>2</small>
                </label>
                <input type="text" placeholder="مؤشر كتلة الجسم" name="bmi" id="bmi" class="form-control" value="">
            </div>
        </div>

        <!-- المقياس -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="cdc"> تحديث النتائج وفق مقياس: </label>
                <select class="form-control" onchange="CalcIt(this.form)" name="cdc" id="cdc">
                    <option>منظمة الصحة العالمية - CDC</option>
                    <option selected="">halls.md v2</option>
                </select>
            </div>
        </div>

    </div>

    <input type="hidden" name="kgcmP">
</form>