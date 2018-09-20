<?php echo $header; ?><?php echo $column_left; ?>
	<div id="content">
		<div class="page-header">
			<div class="container-fluid">
				<div class="pull-right">
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-newsletter').submit() : false;"><i class="fa fa-trash-o"></i></button>
				</div>
				<h1><?php echo $heading_title; ?></h1>
				<ul class="breadcrumb">
					<?php foreach ($breadcrumbs as $breadcrumb) { ?>
						<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="container-fluid">
			<?php if($error_warning) { ?>
				<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php } ?>
			<?php if($success) { ?>
				<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php } ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
				</div>
				<div class="panel-body">
					<form action="<?php echo $deletel; ?>" method="post" enctype="multipart/form-data" id="form-newsletter">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
								<tr>
									<td style="width: 1px;" class="text-center">
										<input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
									<td class="text-left"><?php echo $column_name; ?></a></td>
									<td class="text-left"><?php echo $column_email; ?></a></td>
									<td class="text-left"><?php echo $column_content; ?></a></td>
									<td class="text-left"><?php echo $column_date_added; ?></a></td>
								</tr>
								</thead>
								<tbody>
								<?php if($newsletters) { ?><?php foreach ($newsletters as $newsletter) { ?>
									<tr>
										<td class="text-center">
											<?php if(in_array($newsletter['newsletter_id'], $selected)) { ?>
												<input type="checkbox" name="selected[]" value="<?php echo $newsletter['newsletter_id']; ?>" checked="checked" />
											<?php } else { ?>
												<input type="checkbox" name="selected[]" value="<?php echo $newsletter['newsletter_id']; ?>" />
											<?php } ?></td>
										<td class="text-left"><?php echo $newsletter['name']; ?></td>
										<td class="text-left"><?php echo $newsletter['email']; ?></td>
										<td class="text-left" style="max-width: 300px;"><?php echo $newsletter['enquiry']; ?></td>
										<td class="text-left"><?php echo $newsletter['date_added']; ?></td>
									</tr>
								<?php } ?><?php } else { ?>
									<tr>
										<td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</form>
					<div class="row">
						<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
						<div class="col-sm-6 text-right"><?php echo $results; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo $footer; ?>