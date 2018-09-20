<?php echo $header; ?>
<?php if($config_success == 1) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> Config Success!
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php } ?>
<?php if($error_warning) { ?>
	<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php } ?>
	<div class="row">
		<div class="col-sm-12">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				<p><?php echo $text_db_connection; ?></p>
				<fieldset>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-db-driver"><?php echo $entry_db_driver; ?></label>
						<div class="col-sm-10">
							<select name="db_driver" id="input-db-driver" class="form-control">
								<?php if($mysqli) { ?><?php if($db_driver == 'mysqli') { ?>
									<option value="mysqli" selected="selected"><?php echo $text_mysqli; ?></option>
								<?php } else { ?>
									<option value="mysqli"><?php echo $text_mysqli; ?></option>
								<?php } ?><?php } ?>
								<?php if($pdo) { ?><?php if($db_driver == 'mpdo') { ?>
									<option value="mpdo" selected="selected"><?php echo $text_mpdo; ?></option>
								<?php } else { ?>
									<option value="mpdo"><?php echo $text_mpdo; ?></option>
								<?php } ?><?php } ?>
								<?php if($pgsql) { ?><?php if($db_driver == 'pgsql') { ?>
									<option value="pgsql" selected="selected"><?php echo $text_pgsql; ?></option>
								<?php } else { ?>
									<option value="pgsql"><?php echo $text_pgsql; ?></option>
								<?php } ?><?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-db-hostname"><?php echo $entry_db_hostname; ?></label>
						<div class="col-sm-10">
							<input type="text" name="db_hostname" value="<?php echo $db_hostname; ?>" id="input-db-hostname" class="form-control" />
							<?php if($error_db_hostname) { ?>
								<div class="text-danger"><?php echo $error_db_hostname; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-db-username"><?php echo $entry_db_username; ?></label>
						<div class="col-sm-10">
							<input type="text" name="db_username" value="<?php echo $db_username; ?>" id="input-db-username" class="form-control" />
							<?php if($error_db_username) { ?>
								<div class="text-danger"><?php echo $error_db_username; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-db-password"><?php echo $entry_db_password; ?></label>
						<div class="col-sm-10">
							<input type="text" name="db_password" value="<?php echo $db_password; ?>" id="input-db-password" class="form-control" />
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-db-database"><?php echo $entry_db_database; ?></label>
						<div class="col-sm-10">
							<input type="text" name="db_database" value="<?php echo $db_database; ?>" id="input-db-database" class="form-control" />
							<?php if($error_db_database) { ?>
								<div class="text-danger"><?php echo $error_db_database; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-db-port"><?php echo $entry_db_port; ?></label>
						<div class="col-sm-10">
							<input type="text" name="db_port" value="<?php echo $db_port; ?>" id="input-db-port" class="form-control" />
							<?php if($error_db_port) { ?>
								<div class="text-danger"><?php echo $error_db_port; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-db-prefix"><?php echo $entry_db_prefix; ?></label>
						<div class="col-sm-10">
							<input type="text" name="db_prefix" value="<?php echo $db_prefix; ?>" id="input-db-prefix" class="form-control" />
							<?php if($error_db_prefix) { ?>
								<div class="text-danger"><?php echo $error_db_prefix; ?></div>
							<?php } ?>
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