<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <p class="col-title"><?php echo $config_name; ?></p>
                <p><i class="fa fa-map-marker" style="color: #03B5F1; font-size: 15px;"></i>&nbsp;&nbsp;<strong>Văn phòng:</strong> <?php echo $config_address; ?></p>
                <p><i class="fa fa-envelope" style="color: #03B5F1; font-size: 15px;"></i>&nbsp;&nbsp;<strong>Email:</strong> <?php echo $config_email; ?></p>
                <p><i class="fa fa-phone" style="color: #03B5F1; font-size: 15px;"></i>&nbsp;&nbsp;<strong>Điện thoại:</strong> <?php echo $config_telephone; ?></p>
				<p><strong>Đặt hàng Online:</strong> 04. 35773286</p>
                <p><strong>Showroom 1:</strong> 41 Xã Đàn, Đống Đa, Hà Nội</p>
                <p><strong>Showroom 2:</strong> Số 192 , tổ 4, TT chợ Đông Anh</p>
                <p><strong>Showroom 3:</strong> Toà T7 , Tầng 23 - 05 , Time City, 458 Minh Khai, Hai Bà Trưng, Hà Nội</p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <p class="col-title">Hướng dẫn</p>
                <?php foreach ($menus as $menu){ ?>
                    <p><a href="<?php echo $menu['href']; ?>" title="<?php echo $menu['name']; ?>"><?php echo $menu['name']; ?></a></p>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div id="fb-root"></div>
                <script>(function (d, s, id){
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=1776742159222313";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-page" data-href="<?php echo $config_social_facebook?>" data-tabs="timeline" data-width="300" data-height="220" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="<?php echo $config_social_facebook?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $config_social_facebook?>">Facebook</a></blockquote>
                </div>
            </div>
        </div>
    <a href="#0" class="cd-top">Top</a>
    </div>
</footer>
</body></html>