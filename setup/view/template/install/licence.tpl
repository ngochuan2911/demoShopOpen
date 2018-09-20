<?php echo $header; ?>
<?php if($config_success == 1) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> Config Success!
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php } ?>
	<div class="row">
		<div class="col-sm-12">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				<p><?php echo $text_licence; ?></p>
				<fieldset>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-db-hostname"><?php echo $entry_licence; ?></label>
						<div class="col-sm-10">
							<textarea name="licence" class="form-control"><?php echo $licence; ?></textarea>
						</div>
					</div>
				</fieldset>
				<div class="buttons">
					<div class="pull-right">
						<input type="submit" value="<?php echo $button_config; ?>" class="btn btn-primary" />
					</div>
				</div>
			</form>
		</div>
	</div>
<?php echo $footer; ?>