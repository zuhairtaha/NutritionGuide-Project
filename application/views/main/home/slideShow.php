<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/SlitSlider/css/demo.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/SlitSlider/css/style.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/SlitSlider/css/custom.min.css"/>
<script type="text/javascript" src="<?= base_url() ?>assets/SlitSlider/js/modernizr.custom.79639.js"></script>
<noscript>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/SlitSlider/css/styleNoJS.min.css"/>
</noscript>
<div class="row demo-1">
    <!-- Codrops top bar -->
    <!--/ Codrops top bar -->
    <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">
            
            <div class="sl-slide bg-1" data-orientation="horizontal" data-slice1-rotation="-25"
                 data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner">
                    <div class="deco"><i class="fa fa-cutlery"></i></div>
                    <h2>أهلاً وسهلاً بكم في موقع الدليل الغذائي الإلكتروني</h2>
                </div>
            </div>
            
            <div class="sl-slide bg-2" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15"
                 data-slice1-scale="1.5" data-slice2-scale="1.5">
                <div class="sl-slide-inner">
                    <div class="deco"><i class="fa fa-apple"></i></div>
                    <h2>في موقعنا تجدون باقة من التصنيفات الغذائية ومواد غذائية مع المواصفات</h2>
                </div>
            </div>
            
            <div class="sl-slide bg-3" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3"
                 data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="deco"><i class="fa fa-pagelines"></i></div>
                    <h2>كما نقدم لكم باقة من النصائح الغذائية حسب الفئات العمرية</h2>
                </div>
            </div>
            
            <div class="sl-slide bg-4" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25"
                 data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="deco"><i class="fa fa-check-square-o"></i></div>
                    <h2>دقة معلوماتنا وجودة محتوى موقعنا هو سر نجاحنا</h2>
                </div>
            </div>
            
            <div class="sl-slide bg-5" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10"
                 data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="deco"><i class="fa fa-comments-o"></i></div>
                    <h2>بادروا بالانتساب لموقعنا والمشاركة والتعليق</h2>
                </div>
            </div>
            
        </div><!-- /sl-slider -->
        <nav id="nav-arrows" class="nav-arrows">
            <span class="nav-arrow-prev">Previous</span>
            <span class="nav-arrow-next">Next</span>
        </nav>
        <nav id="nav-dots" class="nav-dots">
            <span class="nav-dot-current"></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </nav>
    </div><!-- /slider-wrapper -->
</div>
<script type="text/javascript" src="<?= base_url() ?>assets/SlitSlider/js/jquery.ba-cond.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/SlitSlider/js/jquery.slitslider.min.js"></script>
<script type="text/javascript">
    $(function () {
        var Page = (function () {
            var $navArrows = $('#nav-arrows'),
                $nav       = $('#nav-dots').find('> span'),
                slitslider = $('#slider').slitslider({
                    onBeforeChange: function (slide, pos) {
                        $nav.removeClass('nav-dot-current');
                        $nav.eq(pos).addClass('nav-dot-current');
                    }
                }),

                init       = function () {
                    initEvents();
                },
                initEvents = function () {
                    // add navigation events
                    $navArrows.children(':last').on('click', function () {
                        slitslider.next();
                        return false;
                    });
                    $navArrows.children(':first').on('click', function () {
                        slitslider.previous();
                        return false;
                    });
                    $nav.each(function (i) {
                        $(this).on('click', function (event) {
                            var $dot = $(this);
                            if (!slitslider.isActive()) {
                                $nav.removeClass('nav-dot-current');
                                $dot.addClass('nav-dot-current');
                            }

                            slitslider.jump(i + 1);
                            return false;
                        });
                    });
                };
            return {init: init};
        })();
        Page.init();

        /**
         * Notes:
         *
         * example how to add items:
         */
        /*
         var $items  = $('<div class="sl-slide sl-slide-color-2" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1"><div class="sl-slide-inner bg-1"><div class="sl-deco" data-icon="t"></div><h2>some text</h2><blockquote><p>bla bla</p><cite>Margi Clarke</cite></blockquote></div></div>');
         // call the plugin's add method
         ss.add($items);
         */
    });
</script>
