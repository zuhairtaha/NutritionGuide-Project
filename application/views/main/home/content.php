<!-- التصنيفات الغذائية -->
<!-- صف شريط أفقي متحرك فيه أصناف الأغذية -->
<div style="display: none;" id="categories_row" class="row">
    <div class="col-lg-12">
        <h3 class="cat-title"><i class="fa fa-cutlery"></i> التصنيفات الغذائية </h3>
        <p class="cat-title-after"></p>
    </div>
    <div class="col-lg-12">
        <div id="horizontal_food_categories">
            <? $c = 1;
            foreach ($categories as $category): ?>
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
                           href="<?= base_url() ?>category/<?= $category->fc_id ?>"><?= $category->fc_title ?></a>
                    </div>
                </div>
                <? $c++; endforeach; ?>
        </div>
    </div>
</div><!-- نهاية شريط أصناف الأغذية -->
<!-- نهاية مواد غذائية مختارة -->
<br/>
<!-- ---------------------------------------------------------------------------------------- -->
<!-- أقسام الموقع -->
<!-- بداية أقسام الموقع -->
<div class="row">
    <div class="col-lg-12">
        <h3 class="cat-title"><i class="fa fa-list"></i> أقسام الموقع </h3>
        <p class="cat-title-after"></p>
    </div>
    <!-- أول 3 أقسام على القياس الكبير -->
    <div class="col-lg-12">
        <? for ($i = 0; $i < 4; $i++): ?>
            <div class="col-lg-3 visible-lg first3parts">
                <div class="grid">
                    <figure class="effect-chico f-370">
                        <img class="img-responsive"
                             src="<?= base_url() ?>assets/uploads/thumb_<?= $parts[$i]->part_image ?>" alt="img15"/>
                        <figcaption>
                            <h4><?= $parts[$i]->part_title ?></h4>
                            <p><?= get_words($parts[$i]->part_description, 7) ?> ... </p>
                            <a href="<?= base_url() . "part/" . $parts[$i]->part_id ?>">View more</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
        <? endfor; ?>
    </div>
</div>
<div class="row">
    <!-- إظهار أول 3 أقسام على شكل ميديا في قياسات الشاشات الصغيرة -->
    <? for ($i = 0; $i < 3; $i++): ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 visible-md visible-sm visible-xs">
            <div class="media margin-bottom-1">
                <div class="media-left">
                    <a href="<?= base_url() . "part/" . $parts[$i]->part_id ?>">
                        <img class="media-object img-size-64"
                             src="<?= base_url() ?>assets/uploads/thumb_<?= $parts[$i]->part_image ?>"
                             alt="<?= $parts[$i]->part_title ?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="<?= base_url() . "part/" . $parts[$i]->part_id ?>"><?= $parts[$i]->part_title ?></a>
                    </h4>
                    <span class="two-lines"><?= $parts[$i]->part_description ?></span>
                </div>
            </div>
        </div>
    <? endfor; ?>
    <? for ($i = 4; $i < sizeof($parts); $i++): ?>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="media margin-bottom-1">
                <div class="media-left">
                    <a href="<?= base_url() . "part/" . $parts[$i]->part_id ?>">
                        <img class="media-object img-size-64"
                             src="<?= base_url() ?>assets/uploads/thumb_<?= $parts[$i]->part_image ?>"
                             alt="<?= $parts[$i]->part_title ?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="<?= base_url() . "part/" . $parts[$i]->part_id ?>"><?= $parts[$i]->part_title ?></a>
                    </h4>
                    <span class="two-lines"><?= $parts[$i]->part_description ?></span>
                </div>
            </div>
        </div>
    <? endfor; ?>
</div>
<!-- نهاية أقسام الموقع -->
<!-- ---------------------------------------------------------------------------------------- -->
<!-- مواد غذائية مختارة -->
<!-- أول صف سلايدات -->
<div class="row">
    <div class="col-lg-12">
        <h3 class="cat-title"><i class="ti-apple"></i> اخترنا لكم (مواد غذائية) </h3>
        <p class="cat-title-after"></p>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-8 visible-lg visible-md visible-sm visible-xs">

        <!-- عينية عشوائية في سلايد شو كبير لأربع مواد غذائية -->
        <!-- المصدر: http://www.jqueryscript.net/slideshow/jQuery-Extension-To-Add-Ken-Burns-Effect-To-Bootstrap-Carousel.html -->
        <div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000"
             data-pause="hover">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <? for ($c = 0; $c < 4; $c++): ?>
                    <li data-target="#kb" data-slide-to="<?= $c ?>" class="<? if ($c == 0) echo 'active'; ?>"></li>
                <? endfor; ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <? for ($i = 0; $i < 4; $i++): ?>
                    <div class="item <? if ($i == 0) echo 'active'; ?>">
                        <img style="width:100%;height:372px;"
                             src="<?= base_url() ?>assets/uploads/thumb_<?= $random_food_stuffs[$i]->f_image ?>"
                             alt="<?= $random_food_stuffs[$i]->f_title ?>">
                        <div class="carousel-caption">
                            <h3>
                                <a class="carousel-anchor"
                                   href="<?= base_url() ?>food/<?= $random_food_stuffs[$i]->f_id ?>">
                                    <?= $random_food_stuffs[$i]->f_title ?>
                                </a>
                            </h3>
                        </div>
                    </div>
                <? endfor; ?>
            </div>
            <!-- Controls -->
            <!-- Navigation Buttons -->
            <!-- Left Button  -->
            <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
                <span class="fa fa-angle-left kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <!-- Right Button  -->
            <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
                <span class="fa fa-angle-right kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- نهاية عينة عشوائية في سلايد شو كبير لأربع مواد غذائية -->

    </div>
    <div class="col-lg-6 col-md-5 col-sm-4">
        <!-- الأربع صور المتبقية من العينة العشوائية من المواد الغذائية -->
        <? for ($i = 4; $i < 10; $i++): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 visible-lg visible-md visible-sm">
                <div class="grid <?
                if ($i >= 6 && $i < 8) echo ' visible-lg visible-md visible-xs';
                if ($i >= 8) echo ' visible-lg visible-xs';
                ?>">
                    <figure class="effect-ruby">
                        <img src="<?= base_url() ?>assets/uploads/thumb_<?= $random_food_stuffs[$i]->f_image ?>"
                             alt="<?= $random_food_stuffs[$i]->f_title ?>"/>
                        <figcaption>
                            <h2 style="font-size:1em"><?= $random_food_stuffs[$i]->f_title ?></h2>
                            <a href="<?= base_url() ?>food/<?= $random_food_stuffs[$i]->f_id ?>">View more</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
        <? endfor; ?>
    </div>
</div> <!-- نهاية أول صف سلايدات -->
<!-- ---------------------------------------------------------------------------------------- -->
<div class="row">
    <div class="col-md-8">
        <!-- آخر المستجدات -->
        <h3 class="cat-title"><i class="fa fa-star"></i> آخر المستجدات </h3>
        <p class="cat-title-after"></p>
        <ul class="nav nav-tabs last_news_tabs">
            <li role="presentation" data-target="last_post_ul" class="active"><a href="#">
                    <i class="visible-xs fa fa-flag"></i>
                    <span class="visible-lg visible-md visible-sm"><i class="fa fa-flag"></i> آخر المقالات</span>
                </a></li>
            <li role="presentation" data-target="most_read_posts_ul"><a href="#">
                    <i class="visible-xs fa fa-newspaper-o"></i>
                    <span class="visible-lg visible-md visible-sm"><i class="fa fa-newspaper-o"></i> الأكثر قراءة</span>
                </a></li>
            <li role="presentation" data-target="last_comments_ul"><a href="#">
                    <i class="visible-xs fa fa-comments-o"></i>
                    <span class="visible-lg visible-md visible-sm"><i class="fa fa-comments-o"></i> آخر التعليقات</span>
                </a>
            </li>
        </ul>
        <ul class="last_ul_list" id="last_post_ul">
            <? foreach ($last_posts as $last_post): ?>
                <li>
                    <a href="<?= base_url() ?><?= $last_post->post_id ?>"><?= $last_post->post_title ?></a>
            <span class="gray_color">, <i class="ti-alarm-clock"></i>
                <time class="timeago" datetime="<?= $last_post->post_date ?>"><?= $last_post->post_date ?></time>
            </span>
                </li>
            <? endforeach; ?>
        </ul>
        <ul class="last_ul_list hide" id="most_read_posts_ul">
            <? foreach ($most_read_posts as $most_read_post): ?>
                <li>
                    <a href="<?= base_url() ?><?= $most_read_post->post_id ?>"><?= $most_read_post->post_title ?></a>
                    <span class="gray_color">, <i class="fa fa-eye"></i> <?= $most_read_post->post_visits ?></span>
                </li>
            <? endforeach; ?>
        </ul>
        <ul class="last_ul_list hide" id="last_comments_ul">
            <? foreach ($last_comments as $comment): ?>
                <li><?= strip_tags($comment->comment_content) ?> ,على مقال
                    <a href="<?= $comment->comment_post_id ?>"><?= $comment->post_title ?></a>
                    <span class="gray_color"> <i class="ti-user"></i> <?= $comment->user_name ?>
                        ,
                <time class="timeago" datetime="<?= $comment->comment_date ?>"><?= $comment->comment_date ?></time>
            </span>
                </li>
            <? endforeach; ?>
        </ul>
        <!-- نهاية آخر المستجدات -->
        <!-- ---------------------------------------------------------------------------------------- -->
    </div>
    <div class="col-md-4">
        <h3 class="cat-title"><i class="fa fa-thumbs-up"></i> تابعنا عبر </h3>
        <p class="cat-title-after"></p>
        <p>
            <!-- صندوق فيس بوك -->
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js     = d.createElement(s);
                js.id  = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=490083544529665";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-page" data-href="http://facebook.com/nitritionguide" data-small-header="true"
             data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
            <div class="fb-xfbml-parse-ignore">
                <blockquote cite="http://facebook.com/nitritionguide"><a href="http://facebook.com/nitritionguide">
                        <i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i>
                        <span class="sr-only">Loading...</span> صفحتنا على فيس بوك
                    </a></blockquote>
            </div>
        </div>
        <!-- نهاية صندوق فيس بوك -->
        </p>
        <p>
            <a href="<?= base_url() ?>assets/com_nitritionguide_com.apk" class="btn btn-primary">
                <i class="fa fa-android"></i> تحميل تطبيق أندرويد
            </a>
        </p>
    </div>
</div>
<!--  -------------------------------------------------------------------- -->