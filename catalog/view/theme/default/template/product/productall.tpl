<?php echo $header; ?>
<?php echo $content_maintop; ?>
<div class="container">
<div class="row" style="margin-top: 20px;"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
        <ul class="breadcrumb" style="background: none;">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        <hr>
        <h1 style="display: none;"><?php echo $heading_title; ?></h1>
        <?php echo $config_meta_productall; ?>
        <?php echo $content_top; ?>
        <div class="row">
            <?php foreach ($products as $product) { ?>
            <div class="product-layout col-lg-3 col-md-3 col-sm-3 col-xs-6">
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
        <div class="row">
            <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
            <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
        <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?></div></div>
<?php echo $content_mainbottom; ?>
<?php echo $footer; ?>
