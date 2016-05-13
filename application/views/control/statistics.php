<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="ti-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?=$comments_count?>
                </div>
                <div class="desc"> التعليقات
                </div>
            </div>
            <a class="more leftText" href="<?=base_url()?>control/comments"> تفاصيل
                <i class="glyphicon glyphicon-chevron-right pull-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual"><i class="ti-pencil-alt"></i></div>
            <div class="details">
                <div class="number">
                    <?=$posts_count?>
                </div>
                <div class="desc"> عدد المقالات</div>
            </div>
            <a class="more leftText" href="<?=base_url()?>control/posts"> تفاصيل
                <i class="glyphicon glyphicon-chevron-right pull-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
            <div class="visual">
                <i class="ti-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?= $users_count ?>
                </div>
                <div class="desc"> عدد الأعضاء</div>
            </div>
            <a class="more leftText" href="<?=base_url()?>control/users"> تفاصيل
                <i class="glyphicon glyphicon-chevron-right pull-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">
                <i class="ti-rss-alt"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?= $online[0]->online ?>
                </div>
                <div class="desc"> المتواجدون الآن
                </div>
            </div>
            <a class="more leftText" href="<?=base_url()?>control/users"> تفاصيل
                <i class="glyphicon glyphicon-chevron-right pull-right"></i>
            </a>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-lg-12">

        <!-- ------ chart start: ---------------------- -->
        <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
        <div style="width:100%">
            <div>
                <canvas id="canvas" height="150" width="600"></canvas>
            </div>
        </div>

        <script>
            var randomScalingFactor = function () {
                return Math.round(Math.random() * 100)
            };
            var lineChartData = {
                labels: [<? foreach ($hits as $h) echo '"' . $h->d . '",'; ?>],
                datasets: [
                    {
                        label: "إحصائيات الزوار",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [<? foreach ($hits as $h) echo $h->h . ","; ?>]
                    },
                    {
                        label: "إحصائيات الزيارات",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [<? foreach ($hits as $h) echo $h->h2 . ","; ?>]
                    }
                ]

            }

            window.onload = function () {
                var ctx       = document.getElementById("canvas").getContext("2d");
                window.myLine = new Chart(ctx).Line(lineChartData, {
                    responsive: true
                });
            }


        </script>
        <!-- ------ chart end; ---------------------- -->
    </div>
</div>