<?php echo $header; ?><?php echo $content_maintop; ?>
    <div class="container">
    <?php if ($attention) { ?>
    <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>

    <div class="row" style="margin-top: 20px;">
        <?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <h1 style="display: none;">Thanh toán đơn hàng</h1>

        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <ul class="breadcrumb" style="background: none;">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
            <hr>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <h2 style="font-size: 18px;"><i class="fa fa-shopping-cart"></i> Đơn hàng</h2>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="font-weight: bold;">
                                <tr>
                                    <td class="text-center"><?php echo $column_image; ?></td>
                                    <td class="text-left"><?php echo $column_name; ?></td>
                                    <td class="text-left"><?php echo $column_quantity; ?></td>
                                    <td class="text-right"><?php echo $column_price; ?></td>
                                    <td class="text-right"><?php echo $column_thanhtien; ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td class="text-center"><?php if ($product['thumb']) { ?>
                                        <a href="<?php echo $product['href']; ?>"><img
                                                    src="<?php echo $product['thumb']; ?>"
                                                    alt="<?php echo $product['name']; ?>"
                                                    title="<?php echo $product['name']; ?>" class="img-thumbnail"/></a>
                                        <?php } ?></td>
                                    <td class="text-left"><a
                                                href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                        <?php if (!$product['stock']) { ?>
                                        <span class="text-danger">***</span>
                                        <?php } ?>
                                        <?php if ($product['option']) { ?>
                                        <?php foreach ($product['option'] as $option) { ?>
                                        <br/>
                                        <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php if ($product['reward']) { ?>
                                        <br/>
                                        <small><?php echo $product['reward']; ?></small>
                                        <?php } ?>
                                        <?php if ($product['recurring']) { ?>
                                        <br/>
                                        <span class="label label-info"><?php echo $text_recurring_item; ?></span>
                                        <small><?php echo $product['recurring']; ?></small>
                                        <?php } ?></td>
                                    <td class="text-left">
                                        <div class="input-group btn-block" style="max-width: 200px;">
                                            <span class="input-group-btn">
                                            <button class="btn btn-default q_minus" type="button"><i class="fa fa-minus"></i></button>
                                        </span>
                                        <input type="text" name="quantity[<?php echo $product['cart_id']; ?>]"
                                               value="<?php echo $product['quantity']; ?>" size="1"
                                               class="form-control text-center quantity"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default q_plus" type="button"><i class="fa fa-plus"></i></button>
                                        </span>
                                        </div>


                                        <div class="clear_both" style="margin-bottom: 10px;"></div>
                                        <button type="submit" title="<?php echo $button_update; ?>"
                                                class="btn btn-primary" name="update_number"><i class="fa fa-refresh"></i> Cập nhật</button>
                                        <button type="button" title="<?php echo $button_remove; ?>"
                                                class="btn btn-danger" onclick="cart.remove('<?php echo $product['cart_id']; ?>');"><i
                                                    class="fa fa-times-circle"></i> Bỏ</button>
                                    </td>
                                    <td class="text-right"><?php echo $product['price']; ?></td>
                                    <td class="text-right"><?php echo $product['total']; ?></td>
                                </tr>
                                <?php } ?>
                                <?php foreach ($vouchers as $voucher) { ?>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><?php echo $voucher['description']; ?></td>
                                    <td class="text-left"></td>
                                    <td class="text-left">
                                        <div class="input-group btn-block" style="max-width: 200px;">
                                            <input type="text" name="" value="1" size="1" disabled="disabled"
                                                   class="form-control"/>
                    <span class="input-group-btn">
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>"
                            class="btn btn-danger" onclick="voucher.remove('<?php echo $voucher['key']; ?>');"><i
                                class="fa fa-times-circle"></i></button>
                    </span></div>
                                    </td>
                                    <td class="text-right"><?php echo $voucher['amount']; ?></td>
                                    <td class="text-right"><?php echo $voucher['amount']; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <?php $i = 1; ?>
                                <?php foreach ($totals as $total) { ?>
                                    <?php if($i == 2){ ?>
                                        <tr>
                                            <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
                                            <td class="text-right"  style="font-size: 20px; color:#087b39; font-weight: bold"><?php echo $total['text']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php $i++;} ?>
                            </table>
                        </div>
                    </div>
            </form>
            <form action="" method="post">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <h2 style="font-size: 18px;"><i class="fa fa-user"></i> Thông tin giao hàng</h2>

                    <div class="alert alert-success">
                        Quý khách vui lòng nhập đầy đủ các thông tin và chọn phương thức thanh toán.
                    </div>
                    <div class="form-group row required">
                        <label class="col-sm-12 control-label" for="input-firstname">Họ và tên:̣</label>

                        <div class="col-sm-12">
                            <input type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control"/>
                            <?php if($error_firstname) { ?>
                            <span class="alert alert-danger"><?php echo $error_firstname; ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label class="col-sm-12 control-label" for="input-email">Email:̣</label>

                        <div class="col-sm-12">
                            <input type="text" name="email" value="<?php echo $email; ?>" class="form-control"/>
                            <?php if($error_email) { ?>
                            <span class="alert alert-danger"><?php echo $error_email; ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label class="col-sm-12 control-label" for="input-telephone">Điện thoại:̣</label>

                        <div class="col-sm-12">
                            <input type="text" name="telephone" value="<?php echo $telephone; ?>" class="form-control"/>
                            <?php if($error_telephone) { ?>
                            <span class="alert alert-danger"><?php echo $error_telephone; ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label class="col-sm-12 control-label" for="input-address_1">Địa chỉ:̣</label>

                        <div class="col-sm-12">
                            <input type="text" name="address_1" value="<?php echo $address_1; ?>" class="form-control"/>
                            <?php if($error_address_1) { ?>
                            <span class="alert alert-danger"><?php echo $error_address_1; ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 control-label" for="input-address_1">Ghi chú thêm:̣</label>

                        <div class="col-sm-12">
                            <textarea name="notes" class="form-control"><?php echo $notes; ?></textarea>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 style="font-size: 18px;"><i class="fa fa-money"></i> Phương thức thanh toán</h2>
                <?php if($error_payment_method) { ?>
                <span class="alert alert-danger"><?php echo $error_payment_method; ?></span>
                <?php } ?>
                <?php foreach($payments as $pay){ ?>
                <h4><input type="radio" value="<?php echo $pay['title']; ?>"
                           name="payment_method" <?php if($pay['title'] == $payment_method) echo 'checked="checked"'; ?>
                    /> <?php echo $pay['title']; ?></h4>

                <div class="well well-sm">
                    <?php echo $pay['description']; ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="alert alert-info">
            <?php echo $payment_note; ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <?php foreach ($totals as $total) { ?>
                    <tr>
                        <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
                        <td class="text-right"
                            style="font-size: 20px; color:#087b39; font-weight: bold"><?php echo $total['text']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="buttons">
            <div class="pull-left"><a href="<?php echo $continue; ?>" class="btn btn-danger"><?php echo $button_shopping; ?></a></div>
            <div class="pull-right"><input type="submit" class="btn btn-primary" name="send_form" value="Gửi đơn hàng"/></div>
        </div>
        </form>
        <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
    $('.q_minus').on('click', function () {
        var parent_div = $(this).parent().parent();
        var quantity = parent_div.children('input');

        if (parseInt(quantity.val()) > 1) {
            quantity.val(parseInt(quantity.val()) - 1);
        } else {
            quantity.val(1);
        }
    });
    $('.q_plus').on('click', function () {
        var parent_div = $(this).parent().parent();
        var quantity = parent_div.children('input');

        if (parseInt(quantity.val()) < 1000) {
            quantity.val(parseInt(quantity.val()) + 1);
        } else {
            quantity.val(1);
        }
    });
    //--></script>
<?php echo $footer; ?> 