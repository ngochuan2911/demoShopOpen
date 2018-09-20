<div class="container" style="margin-bottom: 50px;">
<ul class="rslides" id="slider<?php echo $module; ?>">
  <?php foreach($banners as $banner){ ?>
    <li>
      <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>">
      <!--<p class="caption">This is a caption</p>-->
    </li>
  <?php } ?>
</ul>
</div>
<script type="text/javascript"><!--
  $("#slider<?php echo $module; ?>").responsiveSlides({
    timeout: 2000,
    speed: 500,
    pauseControls: true,
    pause: true
  });
  --></script>