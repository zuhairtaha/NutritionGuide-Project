<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="ti-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo(rand(10,100)); ?>
                </div>
                <div class="desc"> التعليقات
                </div>
            </div>
            <a class="more leftText" href="posts"> تفاصيل
                <i class="glyphicon glyphicon-chevron-right pull-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual"><i class="ti-pencil-alt"></i></div>
            <div class="details">
                <div class="number">
                    <?php echo(rand(10,100)); ?>
                </div>
                <div class="desc"> عدد المنشورات</div>
            </div>
            <a class="more leftText" href="members"> تفاصيل
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
                    <?php echo(rand(10,100)); ?>
                </div>
                <div class="desc"> عدد الأعضاء</div>
            </div>
            <a class="more leftText" href="posts"> تفاصيل
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
                    <?php echo(rand(10,100)); ?>
                </div>
                <div class="desc"> المتواجدون الآن
                </div>
            </div>
            <a class="more leftText" href="posts"> تفاصيل
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
                <canvas width="1094" height="273" id="canvas" style="width: 1094px; height: 273px;"></canvas>
            </div>
        </div>

        <script>
            var randomScalingFactor = function () {
                return Math.round(Math.random() * 100)
            };
            var lineChartData = {
                labels: ["2016-04-18", "2016-04-17", "2016-04-16", "2016-04-15", "2016-04-14", "2016-04-13", "2016-04-12", "2016-04-11", "2016-04-10", "2016-04-09", "2016-04-08", "2016-04-07", "2016-04-06", "2016-04-05", "2016-04-04",],
                datasets: [
                    {
                        label: "إحصائيات الزوار",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [32, 59, 71, 104, 50, 60, 64, 157, 95, 57, 126, 109, 66, 96, 137,]
                    },
                    {
                        label: "إحصائيات الزيارات",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [72, 114, 117, 225, 59, 91, 96, 242, 180, 127, 381, 214, 147, 187, 299,]
                    }
                ]

            };

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