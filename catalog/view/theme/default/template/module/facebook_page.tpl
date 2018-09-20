<div class="container-facebook-page">
    <?php if($config_social_facebook){ ?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=540326366149845";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="facebook-social hidden-xs" style="margin-top: 50px;">
        <div class="panel-heading heading-box"><i class="fa fa-facebook-official" aria-hidden="true"></i>&nbsp; <?php echo $heading_title; ?></div>
        <div style="background: #BFEFFF; height: 5px; width: 100%;"></div>
        <div class="fb-page" data-href="<?php echo $config_social_facebook; ?>" data-tabs="timeline"
             data-small-header="true" data-width="390" data-height="360" data-small-header="false"
             data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
            <div class="fb-xfbml-parse-ignore">
                <blockquote cite="<?php echo $config_social_facebook; ?>"><a
                            href="<?php echo $config_social_facebook; ?>">Facebook</a></blockquote>
            </div>
        </div>
    </div>
    <?php } ?>
</div>