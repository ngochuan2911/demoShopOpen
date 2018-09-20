<?php echo $header; ?><?php echo $column_left; ?>
	<div id="content">
		<div class="page-header">
			<div class="container-fluid">
				<div class="pull-right">
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-menu').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
					<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-menu">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
								<tr>
									<td style="width: 1px;" class="text-center">
										<input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
									<td class="text-left"><?php echo $column_name; ?></a></td>
									<td class="text-right"><?php echo $column_sort_order; ?></a></td>
									<td class="text-right"><?php echo $column_action; ?></td>
								</tr>
								</thead>
								<tbody>
								<?php if($menus) { ?><?php foreach ($menus as $menu) { ?>
									<tr>
										<td class="text-center">
											<?php if(in_array($menu['menu_group_id'], $selected)) { ?>
												<input type="checkbox" name="selected[]" value="<?php echo $menu['menu_group_id']; ?>" checked="checked" />
											<?php } else { ?>
												<input type="checkbox" name="selected[]" value="<?php echo $menu['menu_group_id']; ?>" />
											<?php } ?></td>
										<td class="text-left"><?php echo $menu['name']; ?></td>
										<td class="text-right"><?php echo $menu['sort_order']; ?></td>
										<td class="text-right">
											<?php foreach ($menu['action'] as $action) { ?>
												<a href="<?php echo $action['href']; ?>" data-toggle="tooltip" title="<?php echo $action['text']; ?>" class="btn btn-primary"><i class="<?php echo $action['icon']; ?>"></i></a>
											<?php } ?>
										</td>
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
				</div>
			</div>
		</div>
	</div>
<?php echo $footer; ?>