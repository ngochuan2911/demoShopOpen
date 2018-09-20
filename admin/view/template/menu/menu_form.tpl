<?php echo $header; ?><?php echo $column_left; ?>
	<div id="content">
		<div class="page-header">
			<div class="container-fluid">
				<div class="pull-right">
					<button type="submit" form="form-link_internal" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="panel-body">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-link_internal" class="form-horizontal">
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_menu_type; ?></label>
							<div class="col-sm-10">
								<select name="menu_type_id" class="form-control">
									<option value="0"><?php echo $text_none; ?></option>
									<?php foreach ($menu_types as $menu_type) { ?>
										<?php if ($menu_type['menu_type_id'] == $menu_type_id) { ?>
											<option value="<?php echo $menu_type['menu_type_id']; ?>" selected="selected"><?php echo $menu_type['name']; ?></option>
										<?php } else { ?>
											<option value="<?php echo $menu_type['menu_type_id']; ?>"><?php echo $menu_type['name']; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
								<?php if ($error_menu_type_id) { ?>
									<span class="error"><?php echo $error_menu_type_id; ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_name; ?></label>
							<div class="col-sm-10" id="name_id">
								<select name="name_id" class="form-control"></select>
								<?php if ($error_name_id) { ?>
									<span class="error"><?php echo $error_name_id; ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_parent; ?></label>
							<div class="col-sm-10">
								<select name="parent_id" class="form-control">
									<option value="0"><?php echo $text_none; ?></option>
									<?php foreach ($menus as $menu) { ?>
										<?php if ($menu['menu_id'] == $parent_id) { ?>
											<option value="<?php echo $menu['menu_id']; ?>" selected="selected"><?php echo $menu['name_id']; ?></option>
										<?php } else { ?>
											<option value="<?php echo $menu['menu_id']; ?>"><?php echo $menu['name_id']; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_image; ?></label>
							<div class="col-sm-10">
								<a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="" />
								</a>
								<input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_column; ?></label>
							<div class="col-sm-10">
								<input type="text" name="column" value="<?php echo $column; ?>" size="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_sort_order; ?></label>
							<div class="col-sm-10">
								<input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="1" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_status; ?></label>
							<div class="col-sm-10">
								<select name="status" class="form-control">
									<?php if ($status) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-route"><?php echo $entry_title_description; ?></label>
							<div class="col-sm-10">
								<ul class="nav nav-tabs" id="language-menu-description">
									<?php foreach ($languages as $language) { ?>
										<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
									<?php } ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) { ?>
										<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
											<input type="text" name="description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($description[$language['language_id']]) ? $description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control"/>
											<br>
											<textarea name="description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>" cols="100" rows="10" class="form-control" placeholder="<?php echo $entry_description; ?>"><?php echo isset($description[$language['language_id']]) ? $description[$language['language_id']]['description'] : ''; ?></textarea>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript"><!--
			$('#language a:first').tab('show');
			$('#language-menu-description a:first').tab('show');
			//--></script>
	</div>
	<script type="text/javascript"><!--
		$('select[name=\'menu_type_id\']').bind('change', function (){
			if (this.value != 0){
				$.ajax({
					url       : 'index.php?route=menu/menu/ajaxGetName&token=<?php echo $token; ?>&menu_type_id=' + this.value,
					dataType  : 'json',
					beforeSend: function (){
						$('select[name=\'menu_type_id\']').after('<span class="wait"><i class="fa fa-refresh fa-spin"></i></span>');
					},
					complete  : function (){
						$('.wait').remove();
					},
					success   : function (json){
						html = '<option value="0"><?php echo $text_select; ?></option>';

						if (json['data'] != ''){
							for (i = 0; i < json['data'].length; i++){
								html += '<option value="' + json['data'][i][json.route] + '"';

								if (json['data'][i][json.route] == '<?php echo $name_id; ?>'){
									html += ' selected="selected"';
								}

								if(json.route == 'information_id'){
									html += '>' + json['data'][i]['title'] + '</option>';
								} else {
									html += '>' + json['data'][i]['name'] + '</option>';
								}
							}
						} else{
							html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
						}

						$('select[name=\'name_id\']').html(html);

					},
					error     : function (xhr, ajaxOptions, thrownError){
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			} else{
				$('select[name=\'name_id\']').remove();
				$('#name_id').append('<select name="name_id" class="form-control"></select>');
			}
		});

		$('select[name=\'menu_type_id\']').trigger('change');
		//--></script>
	<script type="text/javascript"><!--
		function image_upload(field, thumb){
			$('#dialog').remove();

			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

			$('#dialog').dialog({
				title    : '<?php echo $text_image_manager; ?>',
				close    : function (event, ui){
					if ($('#' + field).attr('value')){
						$.ajax({
							url     : 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
							dataType: 'text',
							success : function (data){
								$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
							}
						});
					}
				},
				bgiframe : false,
				width    : 960,
				height   : 550,
				resizable: false,
				modal    : false,
				dialogClass: 'dlg'
			});
		}
		;
		//--></script>
	<script type="text/javascript"><!--
		$('#tabs a').tabs();
		$('#languages a').tabs();
		//--></script>
<?php echo $footer; ?>