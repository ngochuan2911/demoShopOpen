<div class="hidden-lg hidden-md hidden-sm">
    <div class="row">
  <?php foreach ($banners as $banner) { ?>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding: 0;">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" style="width: 100%;"/></a>
    <?php } ?>
  </div>
  <?php } ?>
    </div>
</div>
<div class="hidden-xs" style="max-width: 820px;">
    <?php $demi = 1; ?>
    <?php foreach ($banners as $banner) { ?>
        <a href="<?php echo $banner['link']; ?>" style="display: inline-block;"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" style="width: 100%;"/></a>
    <?php $demi++;} ?>
</div>
