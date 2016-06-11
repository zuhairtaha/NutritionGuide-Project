<? $o = $options[0]; ?>
<footer class="row well">
    @ جميع الحقوق محفوظة 2016 -
    <a target="_blank" class="social_btn btn btn-xs btn-primary" href="<?= $o->facebook ?>"><i
            class="fa fa-facebook"></i></a>
    <a target="_blank" class="social_btn btn btn-xs btn-danger" href="<?= $o->youtube ?>"><i class="fa fa-youtube"></i></a>
    <a target="_blank" class="social_btn btn btn-xs btn-info" href="<?= $o->twitter ?>"><i
            class="fa fa-twitter"></i></a>
    <a target="_blank" class="social_btn btn btn-xs btn-warning" href="<?= base_url() ?>rss"><i
            class="fa fa-rss"></i></a>
    <div class="visible-sm visible-xs"><br/><br/><br/></div>
</footer>

</div><!-- /main-container -->


<script charset="UTF-8" src="<?= base_url() ?>assets/js/main.min.js"></script>
<? if (current_url() == base_url()): ?>
    <!-- KenBurinsEffect السلايد شو في الرئيسية (زوم إن أوت) ملف الجافا سكربت ضمن كود Main.js -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.6/KenBurnsEffect/ken-burns.min.css">
    <script type="text/javascript" src="<?= base_url() ?>assets/slick/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap-3.3.6/KenBurnsEffect/ken-burns.min.js"></script>

<? endif; ?>


<!-- أزرار المشاركة في الشبكات الاجتماعية -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=zuhairtaha"></script>

</body>
</html>