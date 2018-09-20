<div class="container list-manufacturer">
	<div style="background: #FFF; border-bottom: 5px #37CBFC solid; border-top: 5px #DEDEDE solid; overflow: auto;">
	<?php foreach($manufacturers as $manufacturer){ ?>
		<div class="col-sm-2 col-xs-4">
			<a href="<?php echo $manufacturer['href'];?>" title="<?php echo $manufacturer['name'];?>">
				<img src="<?php echo $manufacturer['thumb'];?>" alt="<?php echo $manufacturer['name'];?>" class="img-responsive" style="width: 100%;"/>
			</a>
		</div>
	<?php } ?>
	</div>
</div>