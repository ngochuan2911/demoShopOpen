<div class="container" style="margin-bottom: 50px;">
  <h3 class="product-by-category-title"><?php echo $heading_title; ?></h3>
  <div id="carouselpbc<?php echo $modulepbc; ?>" class="owl-carousel">
    <?php foreach ($products as $product) { ?>
      <div class="product-layout item" style="padding: 4px 10px;">
        <div class="product-thumb transition">
          <div class="image">
            <a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" style="width: 100%;" /></a>
          </div>
          <div class="caption">
            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          </div>
          <?php if ($product['price']) { ?><p class="price">
            <?php if (!$product['special']) { ?><?php echo $product['price']; ?><?php } else { ?><span class="price-old" style="font-weight:100; font-size: 12px;"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span><?php } ?>
            </p><?php } ?>
          <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');" class="btn btn-primary btn_oncart"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Mua ngay</span></button>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<script type="text/javascript"><!--
  $('#carouselpbc<?php echo $modulepbc; ?>').owlCarousel({
    items         : 5,
    autoPlay      : 2000,
    navigation    : true,
    navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
    pagination    : true
  });
  --></script>