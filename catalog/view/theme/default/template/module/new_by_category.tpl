<span class="hidden-xs">
<div class="panel-heading heading-box"><i class="fa fa-book" aria-hidden="true"></i>&nbsp; <?php echo $heading_title; ?></div>
<div class="panel-group" style="padding:8px; border:2px #FF7A7A solid; border-top:8px #FF7A7A solid;">
    <div class="row">
        <?php foreach($newss as $new){ ?>
            <div class="col-xs-12" style="margin-bottom: 10px;">
                <a href="<?php echo $new['href'] ?>" title="<?php echo $new['name'] ?>">
                    <img src="<?php echo $new['thumb'] ?>" alt="<?php echo $new['name'] ?>" style="width:80px; height: 80px; float: left; margin-right: 10px;"/>
                </a>
                <a href="<?php echo $new['href'] ?>" title="<?php echo $new['name'] ?>"><strong><?php echo $new['name'] ?></strong></a><br>
                <?php echo $new['description_short'] ?>
                <hr style="margin-bottom: 10px;">
            </div>
        <?php } ?>
    </div>
</div>
</span>