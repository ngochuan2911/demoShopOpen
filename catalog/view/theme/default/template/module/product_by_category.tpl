<div class="container" style="margin-bottom: 30px;">
<div style="border-bottom: 5px <?php echo $color;?> solid;">
	<div class="row">
		<div class="col-sm-5 col-xs-12">
			<a href="<?php echo $category_link;?>" class="hidden-xs"><img src="<?php echo $category_image; ?>" class="img-responsive" style="width: 100%;"/></a>
			<h3 class="module-pbc-title" style="background:<?php echo $color;?>;">
				<a href="<?php echo $category_link;?>"><span><?php echo $heading_title; ?></span></a>
			</h3>
		</div>
		<div class="col-sm-7 col-xs-12">
			<div class="row">
				<?php foreach ($products as $product) { ?>
				<div class="col-sm-4 col-xs-6">
					<div class="product-thumb transition">
						<div class="image">
							<a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"><img src="<?php echo $product['thumb']; ?>"
																		   alt="<?php echo $product['name']; ?>"
																		   title="<?php echo $product['name']; ?>"
																		   class="img-responsive" style="width: 100%;"/></a>
						</div>
						<div class="caption">
							<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
						</div>
						<?php if ($product['price']) { ?>
						<p class="price">
							<?php if (!$product['special']) { ?>
							<?php echo $product['price']; ?>
							<?php } else { ?>
							<span class="price-old" style="font-weight:100; font-size: 12px;"><?php echo $product['price']; ?></span>
							<span class="price-new"><?php echo $product['special']; ?></span>
							<?php } ?>
						</p>
						<?php } ?>
						<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');" class="btn btn-primary btn_oncart"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Mua ngay</span></button>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</div>
