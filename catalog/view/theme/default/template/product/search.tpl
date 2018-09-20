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
        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <ul class="breadcrumb" style="background: none;">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
            <hr>
            <h1><?php echo $heading_title; ?></h1>
            <label class="control-label" for="input-search"><?php echo $entry_search; ?></label>
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" name="search" value="<?php echo $search; ?>"
                           placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control"/>
                </div>
                <div class="col-sm-3">
                    <select name="category_id" class="form-control">
                        <option value="0"><?php echo $text_category; ?></option>
                        <?php foreach ($categories as $category_1) { ?>
                        <?php if ($category_1['category_id'] == $category_id) { ?>
                        <option value="<?php echo $category_1['category_id']; ?>"
                                selected="selected"><?php echo $category_1['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
                        <?php } ?>
                        <?php foreach ($category_1['children'] as $category_2) { ?>
                        <?php if ($category_2['category_id'] == $category_id) { ?>
                        <option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $category_2['category_id']; ?>">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
                        <?php } ?>
                        <?php foreach ($category_2['children'] as $category_3) { ?>
                        <?php if ($category_3['category_id'] == $category_id) { ?>
                        <option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="checkbox-inline">
                        <?php if ($sub_category) { ?>
                        <input type="checkbox" name="sub_category" value="1" checked="checked"/>
                        <?php } else { ?>
                        <input type="checkbox" name="sub_category" value="1"/>
                        <?php } ?>
                        <?php echo $text_sub_category; ?></label>
                </div>
            </div>
            <p>
                <label class="checkbox-inline">
                    <?php if ($description) { ?>
                    <input type="checkbox" name="description" value="1" id="description" checked="checked"/>
                    <?php } else { ?>
                    <input type="checkbox" name="description" value="1" id="description"/>
                    <?php } ?>
                    <?php echo $entry_description; ?></label>
            </p>
            <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-danger"/>
            <br>
            <?php if ($products) { ?>
            <div class="row">
                <div class="col-sm-6 text-right">
                    <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
                </div>
                <div class="col-sm-3 text-right">
                    <select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
                        <?php foreach ($sorts as $sorts) { ?>
                        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                        <option value="<?php echo $sorts['href']; ?>"
                                selected="selected"><?php echo $sorts['text']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-1 text-right">
                    <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
                </div>
                <div class="col-sm-2 text-right">
                    <select id="input-limit" class="form-control" onchange="location = this.value;">
                        <?php foreach ($limits as $limits) { ?>
                        <?php if ($limits['value'] == $limit) { ?>
                        <option value="<?php echo $limits['href']; ?>"
                                selected="selected"><?php echo $limits['text']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br/>
            <div class="row">
                <?php foreach ($products as $product) { ?>
                <div class="product-layout col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <div class="product-thumb transition">
                        <div class="image">
                            <a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"><img
                                        src="<?php echo $product['thumb']; ?>"
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
                            <span class="price-old"
                                  style="font-weight:100; font-size: 12px;"><?php echo $product['price']; ?></span>
                            <span class="price-new"><?php echo $product['special']; ?></span>
                            <?php } ?>
                        </p>
                        <?php } ?>
                        <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"
                                class="btn btn-primary btn_oncart"><i class="fa fa-shopping-cart"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">Mua ngay</span></button>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right"><?php echo $results; ?></div>
            </div>
            <?php } else { ?>
            <p><?php echo $text_empty; ?></p>
            <?php } ?>
            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
    $('#button-search').bind('click', function () {
        url = 'index.php?route=product/search';

        var search = $('#content input[name=\'search\']').prop('value');

        if (search) {
            url += '&search=' + encodeURIComponent(search);
        }

        var category_id = $('#content select[name=\'category_id\']').prop('value');

        if (category_id > 0) {
            url += '&category_id=' + encodeURIComponent(category_id);
        }

        var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');

        if (sub_category) {
            url += '&sub_category=true';
        }

        var filter_description = $('#content input[name=\'description\']:checked').prop('value');

        if (filter_description) {
            url += '&description=true';
        }

        location = url;
    });

    $('#content input[name=\'search\']').bind('keydown', function (e) {
        if (e.keyCode == 13) {
            $('#button-search').trigger('click');
        }
    });

    $('select[name=\'category_id\']').on('change', function () {
        if (this.value == '0') {
            $('input[name=\'sub_category\']').prop('disabled', true);
        } else {
            $('input[name=\'sub_category\']').prop('disabled', false);
        }
    });

    $('select[name=\'category_id\']').trigger('change');
    --></script>
<?php echo $content_mainbottom; ?>
<?php echo $footer; ?>