<?php if($comments) { ?><?php foreach ($comments as $comment) { ?>
	<table class="table table-striped table-bordered">
		<tr>
			<td style="width: 50%;"><strong><?php echo $comment['author']; ?></strong></td>
			<td class="text-right"><?php echo $comment['date_added']; ?></td>
		</tr>
		<tr>
			<td colspan="2"><p><?php echo $comment['text']; ?></p>
				<?php for ($i = 1; $i <= 5; $i++) { ?><?php if($comment['rating'] < $i) { ?>
					<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
				<?php } else { ?>
					<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
				<?php } ?><?php } ?></td>
		</tr>
	</table>
<?php } ?>
	<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
	<p><?php echo $text_no_comments; ?></p>
<?php } ?>
