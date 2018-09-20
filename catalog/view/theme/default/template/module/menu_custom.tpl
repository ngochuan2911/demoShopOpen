<?php if($menus) { ?>
    <div class="container" style="margin-bottom: 30px;">
        <div class="row">
            <?php foreach($menus as $menu){ ?>
                <div class="col-sm-4 col-xs-4">
                    <a href="<?php echo $menu['href']; ?>" title="<?php echo $menu['name']; ?>"><img src="<?php echo $menu['image']; ?>" alt="<?php echo $menu['name']; ?>" class="img-responsve" style="width: 100%;"></a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
