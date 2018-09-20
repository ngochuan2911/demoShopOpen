<?php echo $header; ?><?php echo $content_maintop; ?>
<div class="container">
<div class="row" style="margin-top: 20px;">
    <?php echo $column_left; ?>        <?php if($column_left && $column_right) { ?><?php $class = 'col-sm-6'; ?><?php } elseif($column_left || $column_right) { ?><?php $class = 'col-sm-9'; ?><?php } else { ?><?php $class = 'col-sm-12'; ?><?php } ?>
    <div id="content" class="<?php echo $class; ?>">
        <ul class="breadcrumb" style="background: none;">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        <hr>
        <?php echo $content_top; ?>            <h1><?php echo $heading_title; ?></h1>
        <!-- AddThis Button BEGIN -->
        <!--<div class="addthis_toolbox addthis_default_style" data-url="<?php echo $share; ?>"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a>
            <a class="addthis_counter addthis_pill_style"></a></div>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>-->
        <!-- AddThis Button END -->
        <div>
            <div class="tab-pane active" id="tab-description"><?php echo $description; ?></div>
        </div>
        <?php if($newss) { ?>
        <div class="news-related">
            <p><i class="fa fa-list-alt"></i> Tin tức liên quan</p>
            <ul>
                <?php foreach ($newss as $news){ ?>
                <li><a href="<?php echo $news['href']; ?>" title="<?php echo $news['name']; ?>" alt="<?php echo $news['name']; ?>"><i class="fa fa-plus"></i> <?php echo $news['name']; ?> </a></li>
                <?php } ?>
            </ul>
        </div>
			<?php } ?>            <?php if($tags) { ?>
        <p><?php echo $text_tags; ?>                    <?php for ($i = 0; $i < count($tags); $i++) { ?><?php if($i < (count($tags) - 1)) { ?>                        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,                    <?php } else { ?>
            <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>                    <?php } ?><?php } ?>
        </p>
        <?php } ?>            <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
</div></div>
<script type="text/javascript"><!--
    $('#comment').delegate('.pagination a', 'click', function (e){
        e.preventDefault();

        $('#comment').fadeOut('slow');

        $('#comment').load(this.href);

        $('#comment').fadeIn('slow');
    });

    $('#comment').load('index.php?route=news/news/comment&news_id=<?php echo $news_id; ?>');

    $('#button-comment').on('click', function (){
        $.ajax({
            url       : 'index.php?route=news/news/write&news_id=<?php echo $news_id; ?>',
            type      : 'post',
            dataType  : 'json',
            data      : $("#form-comment").serialize(),
            beforeSend: function (){
                $('#button-comment').button('loading');
            },
            complete  : function (){
                $('#button-comment').button('reset');
            },
            success   : function (json){
                $('.alert-success, .alert-danger').remove();

                if (json['error']){
                    $('#comment').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']){
                    $('#comment').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
            }
        });
    });
    //--></script><?php echo $content_mainbottom; ?>    <?php echo $footer; ?>
