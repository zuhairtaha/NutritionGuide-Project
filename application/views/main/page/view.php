<?
$p = $page[0];
?>
<ol class="breadcrumb">
    <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> الرئيسة</a></li>
    <li><a href="<?=current_url()?>"><i class="fa fa-file-text-o"></i> <?= $p->page_title ?></a></li>
</ol>
<p>
    <?= $p->page_content ?>
</p>