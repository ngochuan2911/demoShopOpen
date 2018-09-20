<div class="panel-heading heading-box"><?php echo $heading_title; ?></div>
<div style="background: #BFEFFF; height: 5px; width: 100%;"></div>
<div class="row">
	<?php foreach ($products as $product) { ?>
		<div class="col-sm-12 col-xs-12">
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
			</div>
		</div>
	<?php } ?>
</div>
