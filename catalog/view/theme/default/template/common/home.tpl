<?php echo $header; ?>
<h1 style="display: none;"><?php echo $heading_title_home; ?></h1>
<?php echo $content_maintop; ?>
<div class="container">
    <div class="row" style="margin-top: 16px;">
        <?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-9'; ?>
            <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
            <?php } ?>
            <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?><?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?>
    </div>
</div>
<?php echo $content_mainbottom; ?>
<?php echo $footer; ?>