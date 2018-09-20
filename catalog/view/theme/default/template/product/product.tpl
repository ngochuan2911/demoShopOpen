<?php echo $header; ?><?php echo $content_maintop; ?>
<div class="container">
<div class="row" style="margin-top: 20px;"><?php echo $column_left; ?>        <?php if($column_left && $column_right) { ?><?php $class = 'col-sm-6'; ?><?php } elseif($column_left || $column_right) { ?><?php $class = 'col-sm-9'; ?><?php } else { ?><?php $class = 'col-sm-12'; ?><?php } ?>
    <div id="content" class="<?php echo $class; ?>">
        <ul class="breadcrumb" style="background: none;">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        <hr>
        <?php echo $content_top; ?>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <?php if($thumb || $images) { ?>
                <ul class="thumbnails">

                    <?php if($thumb) { ?>
                        <li><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="img_01"/></a></li>
                    <?php } ?>

                    <?php if($images) { ?>
                        <?php foreach ($images as $image) { ?>
                            <li class="image-additional"><a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <div style="background: #FBFBFB; padding: 10px;">
                <p><strong>Tên sản phẩm:</strong></p>
                <h1 class="title-product-detail"><?php echo $heading_title; ?></h1>

                <?php if ($price) { ?>
                <p class="price_detail_product">
                    <strong style="color: #000;">Giá bán:</strong>
                    <?php if (!$special) { ?>
                    <?php echo $price; ?>
                    <?php } else { ?>
                    <span class="price-old" style="font-weight:100; font-size: 12px; text-decoration:line-through;"><?php echo $price; ?></span>
                    <span class="price-new"><?php echo $special; ?></span>
                    <?php } ?>
                </p>
                <?php } ?>

                <ul class="list-unstyled">
                    <?php if($manufacturer) { ?>
                    <li><?php echo $text_manufacturer; ?> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></li>
                    <?php } ?>
                    <li><strong><?php echo $text_model; ?>&nbsp;<?php echo $model; ?></strong></li>
                    <?php if($reward) { ?>
                    <li><?php echo $text_reward; ?>&nbsp;<?php echo $reward; ?></li>
                    <?php } ?>
                </ul>
                <div class="share-icon"></div>
                <div class="share"></div>
                <div class="clear_both"></div>
                <br>
                <?php echo $demo; ?>

                <div id="product">
                    <?php if($options) { ?>
                    <hr>
                    <h3><?php echo $text_option; ?></h3>                        <?php foreach ($options as $option) { ?><?php if($option['type'] == 'select') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                        <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($option['product_option_value'] as $option_value) { ?>
                            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>                                    <?php if($option_value['price']) { ?>
                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)                                    <?php } ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?><?php if($option['type'] == 'radio') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label"><?php echo $option['name']; ?></label>
                        <div id="input-option<?php echo $option['product_option_id']; ?>">
                            <?php foreach ($option['product_option_value'] as $option_value) { ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />                                        <?php echo $option_value['name']; ?>                                        <?php if($option_value['price']) { ?>
                                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)                                        <?php } ?>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?><?php if($option['type'] == 'checkbox') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label"><?php echo $option['name']; ?></label>
                        <div id="input-option<?php echo $option['product_option_id']; ?>">
                            <?php foreach ($option['product_option_value'] as $option_value) { ?>
                            <div class="checkbox">
                                <label> <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />                                        <?php if($option_value['image']) { ?>
                                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" />                                        <?php } ?>                                        <?php echo $option_value['name']; ?>                                        <?php if($option_value['price']) { ?>
                                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)                                        <?php } ?>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?><?php if($option['type'] == 'image') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label"><?php echo $option['name']; ?></label>
                        <div id="input-option<?php echo $option['product_option_id']; ?>">
                            <?php foreach ($option['product_option_value'] as $option_value) { ?>
                            <div class="radio">
                                <label> <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $option_value['name']; ?>                                        <?php if($option_value['price']) { ?>
                                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)                                        <?php } ?>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?><?php if($option['type'] == 'text') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                    </div>
                    <?php } ?><?php if($option['type'] == 'textarea') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                        <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
                    </div>
                    <?php } ?><?php if($option['type'] == 'file') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label"><?php echo $option['name']; ?></label>
                        <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                        <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
                    </div>
                    <?php } ?><?php if($option['type'] == 'date') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                        <div class="input-group date">
                            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" /> <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
                    </div>
                    <?php } ?><?php if($option['type'] == 'datetime') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                        <div class="input-group datetime">
                            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" /> <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
                    </div>
                    <?php } ?><?php if($option['type'] == 'time') { ?>
                    <div class="form-group<?php echo($option['required'] ? ' required' : ''); ?>">
                        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                        <div class="input-group time">
                            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" /> <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
                    </div>
                    <?php } ?><?php } ?><?php } ?>                        <?php if($recurrings) { ?>
                    <hr>
                    <h3><?php echo $text_payment_recurring ?></h3>
                    <div class="form-group required">
                        <select name="recurring_id" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($recurrings as $recurring) { ?>
                            <option value="<?php echo $recurring['recurring_id'] ?>"><?php echo $recurring['name'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="help-block" id="recurring-description"></div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" /> <br />
                            </div>
                            <div class="col-sm-6">
                                <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" style="background: #22ABEF; padding: 5px 20px; color: #FFF; border: none; text-transform: uppercase; font-weight: bold; "><?php echo $button_cart; ?></button>
                            </div>
                        </div>
                    </div>
                    <?php if($minimum > 1) { ?>
                    <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if($column_left || $column_right) { ?>                <?php $class = 'col-sm-12'; ?><?php } else { ?><?php $class = 'col-sm-12'; ?><?php } ?>
            <div class="<?php echo $class; ?>">
                <ul class="nav nav-tabs" style="margin-bottom: 0px;">
                    <li class="active"><a href="#tab-description" data-toggle="tab">
                            <?php echo $tab_description; ?></a>
                    </li>
                    <?php if($attribute_groups) { ?>
                        <li><a href="#tab-specification" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-description" style="background: #FFF; padding: 20px; border: 1px #ddd solid; border-top: none;"><?php echo $description; ?></div>
                    <?php if($attribute_groups) { ?>
                    <div class="tab-pane" id="tab-specification">
                        <table class="table table-bordered">
                            <?php foreach ($attribute_groups as $attribute_group) { ?>
                            <thead>
                            <tr>
                                <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                            <tr>
                                <td><?php echo $attribute['name']; ?></td>
                                <td><?php echo $attribute['text']; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php if($column_left || $column_right) { ?><?php $class = 'col-sm-4'; ?><?php } else { ?><?php $class = 'col-sm-4'; ?><?php } ?>
            <div class="<?php echo $class; ?>"></div>
        </div>
        <?php if($tags) { ?>
            <p style="margin-top:5px;">
                <?php echo $text_tags; ?>
                    <?php for ($i = 0; $i < count($tags); $i++) { ?>
                        <?php if($i < (count($tags) - 1)) { ?>
                            <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
                        <?php } else { ?>
                            <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
                    <?php } ?>
                <?php } ?>
            </p>
        <?php } ?>            <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?></div></div>
<script type="text/javascript"><!--
    function setCookie(cname, cvalue, exdays){
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    function getCookie(cname){
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++){
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }
    //--></script>
<script type="text/javascript"><!--
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function (){
        $.ajax({
            url       : 'index.php?route=product/product/getRecurringDescription',
            type      : 'post',
            data      : $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType  : 'json',
            beforeSend: function (){
                $('#recurring-description').html('');
            },
            success   : function (json){
                $('.alert, .text-danger').remove();

                if (json['success']){
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });
    //--></script>
<script type="text/javascript"><!--
    $('#button-cart').on('click', function (){
        $.ajax({
            url       : 'index.php?route=checkout/cart/add',
            type      : 'post',
            data      : $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
            dataType  : 'json',
            beforeSend: function (){
                $('#button-cart').button('loading');
            },
            complete  : function (){
                $('#button-cart').button('reset');
            },
            success   : function (json){
                $('.alert, .text-danger').remove();
                $('.form-group').removeClass('has-error');

                if (json['error']){
                    if (json['error']['option']){
                        for (i in json['error']['option']){
                            var element = $('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')){
                                element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            } else{
                                element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            }
                        }
                    }

                    if (json['error']['recurring']){
                        $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                    }

                    // Highlight any found errors
                    $('.text-danger').parent().addClass('has-error');
                }

                if (json['success']){
                    $('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#cart > button').html('<i class="fa fa-shopping-cart"></i> ' + json['total']);

                    $('html, body').animate({scrollTop: 0}, 'slow');

                    $('#cart > ul').load('index.php?route=common/cart/info ul li');
                }
            },
            error     : function (xhr, ajaxOptions, thrownError){
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    //--></script>
<script type="text/javascript"><!--
    $('.date').datetimepicker({
        pickTime: false
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });

    $('.time').datetimepicker({
        pickDate: false
    });

    $('button[id^=\'button-upload\']').on('click', function (){
        var node = this;

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined'){
            clearInterval(timer);
        }

        timer = setInterval(function (){
            if ($('#form-upload input[name=\'file\']').val() != ''){
                clearInterval(timer);

                $.ajax({
                    url        : 'index.php?route=tool/upload',
                    type       : 'post',
                    dataType   : 'json',
                    data       : new FormData($('#form-upload')[0]),
                    cache      : false,
                    contentType: false,
                    processData: false,
                    beforeSend : function (){
                        $(node).button('loading');
                    },
                    complete   : function (){
                        $(node).button('reset');
                    },
                    success    : function (json){
                        $('.text-danger').remove();

                        if (json['error']){
                            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                        }

                        if (json['success']){
                            alert(json['success']);

                            $(node).parent().find('input').attr('value', json['code']);
                        }
                    },
                    error      : function (xhr, ajaxOptions, thrownError){
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    //--></script>
<script type="text/javascript"><!--
    $('#rating span').click(function (){
        $(this).unbind('mouseout');
        var rating = $(this).attr('alt');
        $('input[name=\'rating\']').val(rating);
    }).mouseover(function (){
        $('#rating span').attr('class', 'off');
        $('#rating span i').attr('class', 'fa fa-star-o');

        for (i = 0; i <= $(this).attr('alt'); i++){
            $('#rating span[alt=\'' + i + '\']').attr('class', 'on');
            $('#rating span[alt=\'' + i + '\'] i').attr('class', 'fa fa-star');
        }
        $(this).bind('mouseout');
    }).mouseout(function (){
        $('#rating span').attr('class', 'off');
        $('#rating span i').attr('class', 'fa fa-star-o');

        for (i = 0; i <= rating; i++){
            $('#rating span[alt=\'' + i + '\']').attr('class', 'on');
            $('#rating span[alt=\'' + i + '\'] i').attr('class', 'fa fa-star');
        }
    });
    //--></script>
<script type="text/javascript"><!--
    /*$('#review').delegate('.pagination a', 'click', function (e){
     e.preventDefault();

     $('#review').fadeOut('slow');

     $('#review').load(this.href);

     $('#review').fadeIn('slow');
     });*/

    //$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

    $('#button-review').on('click', function (){
        $.ajax({
            url       : 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
            type      : 'post',
            dataType  : 'json',
            data      : $("#form-review").serialize(),
            beforeSend: function (){
                $('#button-review').button('loading');
            },
            complete  : function (){
                $('#button-review').button('reset');
            },
            success   : function (json){
                $('.alert-success, .alert-danger').remove();

                if (json['error']){
                    $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']){
                    $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
            }
        });
    });

    $(document).ready(function (){
        $('.thumbnails').magnificPopup({
            type    : 'image',
            delegate: 'a',
            gallery : {
                enabled: true
            }
        });
    });

    $(document).ready(function (){
        setTimeout(function (){
            $.ajax({
                type      : 'POST',
                url       : 'index.php?route=common/footer/getShareProduct',
                dataType  : "json",
                beforeSend: function (){
                    $('.share-icon').html('<i class="fa fa-refresh fa-spin"></i> Đang load...');
                },
                complete  : function (){
                },
                success   : function (data){
                    $('.share-icon').remove();
                    $('.share').html(data);
                }
            });
        }, 1000);
    });

    $("#img_01").elevateZoom();
    //--></script>

<?php echo $content_mainbottom; ?><?php echo $footer; ?>
