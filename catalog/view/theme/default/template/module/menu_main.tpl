<div class="container">
<?php if($menus) { ?>
<div class="hidden-xs">
    <nav id="menu" class="navbar menu_static">
        <div class="navbar-header">
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <?php foreach ($menus as $menu) { ?>
                    <?php if($menu['children']) { ?>
                        <li class="dropdown">
                            <a href="<?php echo $menu['href']; ?>" class="dropdown-toggle"><?php echo $menu['name']; ?></a>
                            <div class="dropdown-menu">
                                <div class="dropdown-inner">
                                    <ul class="list-unstyled">
                                        <?php foreach ($menu['children'] as $menu2) { ?>
                                        <li>
                                            <a href="<?php echo $menu2['href']; ?>"><i class="fa fa-caret-right"></i> <?php echo $menu2['name']; ?></a>
                                            <ul class="menu-third">
                                                <?php foreach ($menu2['children'] as $menu3) { ?>
                                                <li><a href="<?php echo $menu3['href']; ?>"><i class="fa fa-angle-right"></i> <?php echo $menu3['name']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li><a href="<?php echo $menu['href']; ?>"><?php echo $menu['name']; ?></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>
<div class="hidden-lg hidden-md hidden-sm mobile-menu">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" style="background: #BFEFFF;">
            <ul class="nav navbar-nav">
                <?php foreach ($menus as $menu) { ?>
                <?php if($menu['children']) { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu['name']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menu['children'] as $menu2) { ?>
                        <li><a href="<?php echo $menu2['href']; ?>"><i class="fa fa-caret-right"></i> <?php echo $menu2['name']; ?></a></li>
                        <?php if($menu2['children']) { ?>
                        <?php foreach ($menu2['children'] as $menu3) { ?>
                        <li><a href="<?php echo $menu3['href']; ?>" style="text-indent: 10px;"><i class="fa fa-angle-right"></i> <?php echo $menu3['name']; ?></a></li>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
                <?php } else { ?>
                <li><a href="<?php echo $menu['href']; ?>"><?php echo $menu['name']; ?></a></li>
                <?php } ?>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
        <div class="container">
            <?php echo $cart; ?>
        </div>
    </nav>
</div>
</div>
<?php } ?>
<script type="text/javascript"><!--
    $(document).ready(function(){
        var pxscrollmenu_offset = $('.menu_static').offset().top;
        var sosanh = pxscrollmenu_offset + 120;
        $(window).scroll(function () {
            var scrolltop = $(this).scrollTop();
            if (scrolltop > sosanh) {
                $('.menu_scroll').css('visibility', 'visible');
                $('.menu_scroll').css('opacity', '1');
            } else {
                $('.menu_scroll').css('opacity', '0');
                $('.menu_scroll').css('visibility', 'hidden');
            }
        });
    });
    //--></script>