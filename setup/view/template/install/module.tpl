<?php echo $header; ?>
<?php if($text_success != false) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $text_success;?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php } ?>
	<div class="row">
		<div class="col-sm-12">
		<?php if($error_connect_host == 0) {?>
			<p>Check list module.</p>
			<fieldset>
				<table class="table">
					<thead>
					<tr>
						<td><b><?php echo $text_status; ?></b></td>
						<td><b><?php echo $text_extension; ?></b></td>
						<td class="text-right"><b><?php echo $text_action; ?></b></td>
					</tr>
					</thead>
					<tbody>
					<?php foreach($extensions as $extension) { ?>
						<tr>
							<td>
								<?php if($extension['status'] == false) { ?>
									<i class="fa fa-times-circle fa-2x text-danger"></i>
								<?php } else { ?>
									<i class="fa fa-check-circle fa-2x text-success"></i>
								<?php } ?>
							</td>
							<td><p class="<?php if($extension['status'] == false) {echo 'text-danger';}else{echo 'text-success';} ?>" style="margin:0;padding:0;"><?php echo $extension['extension']; ?></p></td>
							<td class="text-right">
								<?php foreach($extension['action'] as $act) { ?>
									<?php if($act['confirm'] == 0) { ?>
										<a href="<?php echo $act['href']; ?>" class="button-module btn <?php if($extension['status'] == false) {echo 'btn-danger';}else{echo 'btn-success';} ?>"><?php echo $act['text']; ?></a>
									<?php } else { ?>
										<a onclick="return confirm('<?php echo $text_confirm; ?><?php echo $extension['extension']; ?>?') ? true : false;" href="<?php echo $act['href']; ?>" class="button-module btn <?php if($extension['status'] == false) {echo 'btn-danger';}else{echo 'btn-success';} ?>"><?php echo $act['text']; ?></a>
									<?php }  ?>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</fieldset>
			<?php } else { ?>
				<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Error connect db. <button type="button" class="close" data-dismiss="alert">x</button></div>
			<?php }  ?>
		</div>
	</div>
</div>
<?php echo $footer; ?>