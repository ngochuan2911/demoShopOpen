<div id="search" class="input-group">
    <input type="text" name="search" value="<?php echo $search; ?>" class="form-control input-lg" /> <span class="input-group-btn">
    <button type="button" class="btn btn-primary btn-lg" id="_button-search"><i class="fa fa-search"></i></button>
  </span>
</div>
<script type="text/javascript"><!--
    /* Search */
    $('#_button-search').bind('click', function (){
        url = 'index.php?route=product/search';
        var search = $('input[name=\'search\']').val();
        if (search){
            url += '&search=' + encodeURIComponent(search);
        }

        location = url;
    });

    $('#menu input[name=\'search\']').bind('keydown', function (e){
        if (e.keyCode == 13){
            $('#_button-search').trigger('click');
        }
    });
    //--></script>