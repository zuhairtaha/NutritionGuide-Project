<? @header('Content-Type: text/xml'); ?>
<rss version="2.0">
    <channel>
        <title><?= $options[0]->site_name ?></title>
        <link><?= base_url() ?></link>
        <description><?= $options[0]->site_description ?></description>


        <? foreach ($last_posts as $last_post): ?>
            <item>
                <title><?= $last_post->post_title ?></title>
                <link><?= base_url() ?><?= $last_post->post_id ?></link>

                <?
                $image_src = get_first_image_if_exist($last_post->post_content);
                // $image_src = str_replace("assets/uploads/","assets/uploads/thumb_",$image_src);
                $image     = "<img src='" . $image_src . "' />";
                $desc      = trim(preg_replace('/\s\s+/', ' ', str_replace("&nbsp;", " ", strip_tags($last_post->post_content))));
                ?>
                <description><![CDATA[ <?= $image ?> <br/><?= $desc ?>]]></description>


                <pubDate>
                    <?
                    $objDate = new DateTime($last_post->post_date);
                    $rssDate = $objDate->format(DateTime::RSS);
                    echo $rssDate;
                    ?>
                </pubDate>


            </item>

        <? endforeach; ?>


    </channel>

</rss>
