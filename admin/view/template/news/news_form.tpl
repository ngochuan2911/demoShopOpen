<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-news" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-news" class="form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
						<li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
						<li><a href="#tab-links" data-toggle="tab"><?php echo $tab_links; ?></a></li>
						<li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
						<li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab-general">
							<ul class="nav nav-tabs" id="language">
								<?php foreach ($languages as $language) { ?>
									<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
									<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
											<div class="col-sm-10">
												<input type="text" onblur="locdau();" name="news_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($news_description[$language['language_id']]) ? $news_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
												<?php if(isset($error_name[$language['language_id']])) { ?>
													<div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
												<?php } ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
											<div class="col-sm-10">
												<textarea name="news_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control ckeditor"><?php echo isset($news_description[$language['language_id']]) ? $news_description[$language['language_id']]['description'] : ''; ?></textarea>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
											<div class="col-sm-10">
												<input type="text" name="news_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($news_description[$language['language_id']]) ? $news_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
												<?php if(isset($error_meta_title[$language['language_id']])) { ?>
													<div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
												<?php } ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
											<div class="col-sm-10">
												<textarea name="news_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($news_description[$language['language_id']]) ? $news_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
											<div class="col-sm-10">
												<textarea name="news_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($news_description[$language['language_id']]) ? $news_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="input-tag<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_tag; ?>"><?php echo $entry_tag; ?></span></label>
											<div class="col-sm-10">
												<input type="text" name="news_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($news_description[$language['language_id']]) ? $news_description[$language['language_id']]['tag'] : ''; ?>" placeholder="<?php echo $entry_tag; ?>" id="input-tag<?php echo $language['language_id']; ?>" class="form-control" />
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="tab-pane" id="tab-data">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
								<div class="col-sm-10">
									<input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
									<?php if($error_keyword) { ?>
										<div class="text-danger"><?php echo $error_keyword; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
								<div class="col-sm-10">
									<select name="status" id="input-status" class="form-control">
										<?php if($status) { ?>
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
								<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
								<div class="col-sm-10">
									<input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-links">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
								<div class="col-sm-10">
									<div class="well scrollbox">
										<?php $class = 'odd'; ?>
										<?php if(!empty($auto_news_categories)) foreach ($auto_news_categories as $auto_news_category) {
											$class = ($class == 'even' ? 'odd' : 'even');
											?>
											<?php
											$check = '';
											foreach($news_categories as $news_category){
												if($news_category == $auto_news_category['category_id']){
													$check = 'checked';
												}
											}
											?>
											<div class="<?php echo $class; ?>">
												<input type="checkbox" name="news_category[]" value="<?php echo $auto_news_category['category_id'];?>" <?php echo $check;?> >
												<?php echo $auto_news_category['name'];?><br>
											</div>
										<?php } ?>
									</div>
									<br>
									<a onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="btn btn-primary"><?php echo $text_select_all; ?></a> <a onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="btn btn-warning"><?php echo $text_unselect_all; ?></a>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-download"><span data-toggle="tooltip" title="<?php echo $help_download; ?>"><?php echo $entry_download; ?></span></label>
								<div class="col-sm-10">
									<div class="well scrollbox">
										<?php $class = 'odd'; ?>
										<?php if(!empty($auto_news_downloads)) foreach ($auto_news_downloads as $auto_news_download) {
											$class = ($class == 'even' ? 'odd' : 'even');
											?>
											<?php
											$check = '';
											foreach($news_downloads as $news_download){
												if($news_download['download_id'] == $auto_news_download['download_id']){
													$check = 'checked';
												}
											}
											?>
											<div class="<?php echo $class; ?>">
												<input type="checkbox" name="news_download[]" value="<?php echo $auto_news_download['download_id'];?>" <?php echo $check;?> >
												<?php echo $auto_news_download['name'];?><br>
											</div>
										<?php } ?>
									</div>
									<br>
									<a onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="btn btn-primary"><?php echo $text_select_all; ?></a> <a onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="btn btn-warning"><?php echo $text_unselect_all; ?></a>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-image">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<td class="text-left"><?php echo $entry_image; ?></td>
									</tr>
									</thead>

									<tbody>
									<tr>
										<td class="text-left"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
											<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" /></td>
									</tr>
									</tbody>
								</table>
							</div>
							<div class="table-responsive">
								<table id="images" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<td class="text-left"><?php echo $entry_additional_image; ?></td>
										<td class="text-right"><?php echo $entry_sort_order; ?></td>
										<td></td>
									</tr>
									</thead>
									<tbody>
									<?php $image_row = 0; ?>
									<?php foreach ($news_images as $news_image) { ?>
										<tr id="image-row<?php echo $image_row; ?>">
											<td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $news_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
												<input type="hidden" name="news_image[<?php echo $image_row; ?>][image]" value="<?php echo $news_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
											<td class="text-right"><input type="text" name="news_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $news_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
											<td class="text-left">
												<button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
											</td>
										</tr>
										<?php $image_row++; ?><?php } ?>
									</tbody>
									<tfoot>
									<tr>
										<td colspan="2"></td>
										<td class="text-left">
											<button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
										</td>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="tab-design">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
									<tr>
										<td class="text-left"><?php echo $entry_store; ?></td>
										<td class="text-left"><?php echo $entry_layout; ?></td>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td class="text-left"><?php echo $text_default; ?></td>
										<td class="text-left"><select name="news_layout[0]" class="form-control">
												<option value=""></option>
												<?php foreach ($layouts as $layout) { ?><?php if(isset($news_layout[0]) && $news_layout[0] == $layout['layout_id']) { ?>
													<option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
												<?php } else { ?>
													<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
												<?php } ?><?php } ?>
											</select></td>
									</tr>
									<?php foreach ($stores as $store) { ?>
										<tr>
											<td class="text-left"><?php echo $store['name']; ?></td>
											<td class="text-left"><select name="news_layout[<?php echo $store['store_id']; ?>]" class="form-control">
													<option value=""></option>
													<?php foreach ($layouts as $layout) { ?><?php if(isset($news_layout[$store['store_id']]) && $news_layout[$store['store_id']] == $layout['layout_id']) { ?>
														<option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
													<?php } else { ?>
														<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
													<?php } ?><?php } ?>
												</select></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
								<div class="col-sm-10">
									<div class="well well-sm" style="height: 150px; overflow: auto;">
										<div class="checkbox">
											<label>
												<?php if(in_array(0, $news_store)) { ?>
													<input type="checkbox" name="news_store[]" value="0" checked="checked" />
													<?php echo $text_default; ?><?php } else { ?>
													<input type="checkbox" name="news_store[]" value="0" />
													<?php echo $text_default; ?><?php } ?>
											</label>
										</div>
										<?php foreach ($stores as $store) { ?>
											<div class="checkbox">
												<label>
													<?php if(in_array($store['store_id'], $news_store)) { ?>
														<input type="checkbox" name="news_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
														<?php echo $store['name']; ?><?php } else { ?>
														<input type="checkbox" name="news_store[]" value="<?php echo $store['store_id']; ?>" />
														<?php echo $store['name']; ?><?php } ?>
												</label>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript"><!--
		// Manufacturer
		$('input[name=\'manufacturer\']').autocomplete({
			'source': function (request, response){
				$.ajax({
					url     : 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success : function (json){
						json.unshift({
							manufacturer_id: 0,
							name           : '<?php echo $text_none; ?>'
						});

						response($.map(json, function (item){
							return {
								label: item['name'],
								value: item['manufacturer_id']
							}
						}));
					}
				});
			},
			'select': function (item){
				$('input[name=\'manufacturer\']').val(item['label']);
				$('input[name=\'manufacturer_id\']').val(item['value']);
			}
		});

		// Category
		$('input[name=\'category\']').autocomplete({
			'source': function (request, response){
				$.ajax({
					url     : 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success : function (json){
						response($.map(json, function (item){
							return {
								label: item['name'],
								value: item['category_id']
							}
						}));
					}
				});
			},
			'select': function (item){
				$('input[name=\'category\']').val('');

				$('#news-category' + item['value']).remove();

				$('#news-category').append('<div id="news-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="news_category[]" value="' + item['value'] + '" /></div>');
			}
		});

		$('#news-category').delegate('.fa-minus-circle', 'click', function (){
			$(this).parent().remove();
		});

		// Filter
		$('input[name=\'filter\']').autocomplete({
			'source': function (request, response){
				$.ajax({
					url     : 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success : function (json){
						response($.map(json, function (item){
							return {
								label: item['name'],
								value: item['filter_id']
							}
						}));
					}
				});
			},
			'select': function (item){
				$('input[name=\'filter\']').val('');

				$('#news-filter' + item['value']).remove();

				$('#news-filter').append('<div id="news-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="news_filter[]" value="' + item['value'] + '" /></div>');
			}
		});

		$('#news-filter').delegate('.fa-minus-circle', 'click', function (){
			$(this).parent().remove();
		});

		// Downloads
		$('input[name=\'download\']').autocomplete({
			'source': function (request, response){
				$.ajax({
					url     : 'index.php?route=catalog/download/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success : function (json){
						response($.map(json, function (item){
							return {
								label: item['name'],
								value: item['download_id']
							}
						}));
					}
				});
			},
			'select': function (item){
				$('input[name=\'download\']').val('');

				$('#news-download' + item['value']).remove();

				$('#news-download').append('<div id="news-download' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="news_download[]" value="' + item['value'] + '" /></div>');
			}
		});

		$('#news-download').delegate('.fa-minus-circle', 'click', function (){
			$(this).parent().remove();
		});

		// Related
		$('input[name=\'related\']').autocomplete({
			'source': function (request, response){
				$.ajax({
					url     : 'index.php?route=catalog/news/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success : function (json){
						response($.map(json, function (item){
							return {
								label: item['name'],
								value: item['news_id']
							}
						}));
					}
				});
			},
			'select': function (item){
				$('input[name=\'related\']').val('');

				$('#news-related' + item['value']).remove();

				$('#news-related').append('<div id="news-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="news_related[]" value="' + item['value'] + '" /></div>');
			}
		});

		$('#news-related').delegate('.fa-minus-circle', 'click', function (){
			$(this).parent().remove();
		});
		//--></script>
	<script type="text/javascript"><!--
		var attribute_row = <?php echo $attribute_row; ?>;

		function addAttribute(){
			html = '<tr id="attribute-row' + attribute_row + '">';
			html += '  <td class="text-left" style="width: 20%;"><input type="text" name="news_attribute[' + attribute_row + '][name]" value="" placeholder="<?php echo $entry_attribute; ?>" class="form-control" /><input type="hidden" name="news_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
			html += '  <td class="text-left">';
			<?php foreach ($languages as $language) { ?>
			html += '<div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span><textarea name="news_attribute[' + attribute_row + '][news_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo $entry_text; ?>" class="form-control"></textarea></div>';
			<?php } ?>
			html += '  </td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#attribute tbody').append(html);

			attributeautocomplete(attribute_row);

			attribute_row++;
		}

		function attributeautocomplete(attribute_row){
			$('input[name=\'news_attribute[' + attribute_row + '][name]\']').autocomplete({
				'source': function (request, response){
					$.ajax({
						url     : 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
						dataType: 'json',
						success : function (json){
							response($.map(json, function (item){
								return {
									category: item.attribute_group,
									label   : item.name,
									value   : item.attribute_id
								}
							}));
						}
					});
				},
				'select': function (item){
					$('input[name=\'news_attribute[' + attribute_row + '][name]\']').val(item['label']);
					$('input[name=\'news_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
				}
			});
		}

		$('#attribute tbody tr').each(function (index, element){
			attributeautocomplete(index);
		});
		//--></script>
	<script type='text/javascript'><!--
		function locdau(){
			var str = (document.getElementById("input-name<?php echo $config_language_id; ?>").value);// lấy chuỗi dữ liệu nhập vào từ form có tên title
			str = str.toLowerCase();// chuyển chuỗi sang chữ thường để xử lý

			/* tìm kiếm và thay thế tất cả các nguyên âm có dấu sang không dấu*/

			str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
			str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
			str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
			str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
			str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
			str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
			str = str.replace(/đ/g, "d");
			str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");

			/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */

			str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
			str = str.replace(/^\-+|\-+$/g, "");//cắt bỏ ký tự - ở đầu và cuối chuỗi
			str = str + '-<?php echo $now;?>.html'; //thêm .html vào sau chuỗi
			document.getElementById("input-keyword").value = str;// xuất kết quả xữ lý ra keyword
		}
		//--></script>
	<script type="text/javascript"><!--
		var option_row = <?php echo $option_row; ?>;

		$('input[name=\'option\']').autocomplete({
			'source': function (request, response){
				$.ajax({
					url     : 'index.php?route=catalog/option/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
					dataType: 'json',
					success : function (json){
						response($.map(json, function (item){
							return {
								category    : item['category'],
								label       : item['name'],
								value       : item['option_id'],
								type        : item['type'],
								option_value: item['option_value']
							}
						}));
					}
				});
			},
			'select': function (item){
				html = '<div class="tab-pane" id="tab-option' + option_row + '">';
				html += '	<input type="hidden" name="news_option[' + option_row + '][news_option_id]" value="" />';
				html += '	<input type="hidden" name="news_option[' + option_row + '][name]" value="' + item['label'] + '" />';
				html += '	<input type="hidden" name="news_option[' + option_row + '][option_id]" value="' + item['value'] + '" />';
				html += '	<input type="hidden" name="news_option[' + option_row + '][type]" value="' + item['type'] + '" />';

				html += '	<div class="form-group">';
				html += '	  <label class="col-sm-2 control-label" for="input-required' + option_row + '"><?php echo $entry_required; ?></label>';
				html += '	  <div class="col-sm-10"><select name="news_option[' + option_row + '][required]" id="input-required' + option_row + '" class="form-control">';
				html += '	      <option value="1"><?php echo $text_yes; ?></option>';
				html += '	      <option value="0"><?php echo $text_no; ?></option>';
				html += '	  </select></div>';
				html += '	</div>';

				if (item['type'] == 'text'){
					html += '	<div class="form-group">';
					html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
					html += '	  <div class="col-sm-10"><input type="text" name="news_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" id="input-value' + option_row + '" class="form-control" /></div>';
					html += '	</div>';
				}

				if (item['type'] == 'textarea'){
					html += '	<div class="form-group">';
					html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
					html += '	  <div class="col-sm-10"><textarea name="news_option[' + option_row + '][value]" rows="5" placeholder="<?php echo $entry_option_value; ?>" id="input-value' + option_row + '" class="form-control"></textarea></div>';
					html += '	</div>';
				}

				if (item['type'] == 'file'){
					html += '	<div class="form-group" style="display: none;">';
					html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
					html += '	  <div class="col-sm-10"><input type="text" name="news_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" id="input-value' + option_row + '" class="form-control" /></div>';
					html += '	</div>';
				}

				if (item['type'] == 'date'){
					html += '	<div class="form-group">';
					html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
					html += '	  <div class="col-sm-3"><div class="input-group date"><input type="text" name="news_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" data-date-format="YYYY-MM-DD" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
					html += '	</div>';
				}

				if (item['type'] == 'time'){
					html += '	<div class="form-group">';
					html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
					html += '	  <div class="col-sm-10"><div class="input-group time"><input type="text" name="news_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" data-date-format="HH:mm" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
					html += '	</div>';
				}

				if (item['type'] == 'datetime'){
					html += '	<div class="form-group">';
					html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
					html += '	  <div class="col-sm-10"><div class="input-group datetime"><input type="text" name="news_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
					html += '	</div>';
				}

				if (item['type'] == 'select' || item['type'] == 'radio' || item['type'] == 'checkbox' || item['type'] == 'image'){
					html += '<div class="table-responsive">';
					html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
					html += '  	 <thead>';
					html += '      <tr>';
					html += '        <td class="text-left"><?php echo $entry_option_value; ?></td>';
					html += '        <td class="text-right"><?php echo $entry_quantity; ?></td>';
					html += '        <td class="text-left"><?php echo $entry_subtract; ?></td>';
					html += '        <td class="text-right"><?php echo $entry_price; ?></td>';
					html += '        <td class="text-right"><?php echo $entry_option_points; ?></td>';
					html += '        <td class="text-right"><?php echo $entry_weight; ?></td>';
					html += '        <td></td>';
					html += '      </tr>';
					html += '  	 </thead>';
					html += '  	 <tbody>';
					html += '    </tbody>';
					html += '    <tfoot>';
					html += '      <tr>';
					html += '        <td colspan="6"></td>';
					html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="<?php echo $button_option_value_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
					html += '      </tr>';
					html += '    </tfoot>';
					html += '  </table>';
					html += '</div>';

					html += '  <select id="option-values' + option_row + '" style="display: none;">';

					for (i = 0; i < item['option_value'].length; i++){
						html += '  <option value="' + item['option_value'][i]['option_value_id'] + '">' + item['option_value'][i]['name'] + '</option>';
					}

					html += '  </select>';
					html += '</div>';
				}

				$('#tab-option .tab-content').append(html);

				$('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove(); $(\'#option a:first\').tab(\'show\')"></i> ' + item['label'] + '</li>');

				$('#option a[href=\'#tab-option' + option_row + '\']').tab('show');

				$('[data-toggle=\'tooltip\']').tooltip({
					container: 'body',
					html     : true
				});

				$('.date').datetimepicker({
					pickTime: false
				});

				$('.time').datetimepicker({
					pickDate: false
				});

				$('.datetime').datetimepicker({
					pickDate: true,
					pickTime: true
				});

				option_row++;
			}
		});
		//--></script>
	<script type="text/javascript"><!--
		var option_value_row = <?php echo $option_value_row; ?>;

		function addOptionValue(option_row){
			html = '<tr id="option-value-row' + option_value_row + '">';
			html += '  <td class="text-left"><select name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][option_value_id]" class="form-control">';
			html += $('#option-values' + option_row).html();
			html += '  </select><input type="hidden" name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][news_option_value_id]" value="" /></td>';
			html += '  <td class="text-right"><input type="text" name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][quantity]" value="" placeholder="<?php echo $entry_quantity; ?>" class="form-control" /></td>';
			html += '  <td class="text-left"><select name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][subtract]" class="form-control">';
			html += '    <option value="1"><?php echo $text_yes; ?></option>';
			html += '    <option value="0"><?php echo $text_no; ?></option>';
			html += '  </select></td>';
			html += '  <td class="text-right"><select name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][price_prefix]" class="form-control">';
			html += '    <option value="+">+</option>';
			html += '    <option value="-">-</option>';
			html += '  </select>';
			html += '  <input type="text" name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
			html += '  <td class="text-right"><select name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][points_prefix]" class="form-control">';
			html += '    <option value="+">+</option>';
			html += '    <option value="-">-</option>';
			html += '  </select>';
			html += '  <input type="text" name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][points]" value="" placeholder="<?php echo $entry_points; ?>" class="form-control" /></td>';
			html += '  <td class="text-right"><select name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][weight_prefix]" class="form-control">';
			html += '    <option value="+">+</option>';
			html += '    <option value="-">-</option>';
			html += '  </select>';
			html += '  <input type="text" name="news_option[' + option_row + '][news_option_value][' + option_value_row + '][weight]" value="" placeholder="<?php echo $entry_weight; ?>" class="form-control" /></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#option-value' + option_row + ' tbody').append(html);
			$('[rel=tooltip]').tooltip();

			option_value_row++;
		}
		//--></script>
	<script type="text/javascript"><!--
		var discount_row = <?php echo $discount_row; ?>;

		function addDiscount(){
			html = '<tr id="discount-row' + discount_row + '">';
			html += '  <td class="text-left"><select name="news_discount[' + discount_row + '][customer_group_id]" class="form-control">';
			<?php foreach ($customer_groups as $customer_group) { ?>
			html += '    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['name']); ?></option>';
			<?php } ?>
			html += '  </select></td>';
			html += '  <td class="text-right"><input type="text" name="news_discount[' + discount_row + '][quantity]" value="" placeholder="<?php echo $entry_quantity; ?>" class="form-control" /></td>';
			html += '  <td class="text-right"><input type="text" name="news_discount[' + discount_row + '][priority]" value="" placeholder="<?php echo $entry_priority; ?>" class="form-control" /></td>';
			html += '  <td class="text-right"><input type="text" name="news_discount[' + discount_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="news_discount[' + discount_row + '][date_start]" value="" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="news_discount[' + discount_row + '][date_end]" value="" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#discount tbody').append(html);

			$('.date').datetimepicker({
				pickTime: false
			});

			discount_row++;
		}
		//--></script>
	<script type="text/javascript"><!--
		var special_row = <?php echo $special_row; ?>;

		function addSpecial(){
			html = '<tr id="special-row' + special_row + '">';
			html += '  <td class="text-left"><select name="news_special[' + special_row + '][customer_group_id]" class="form-control">';
			<?php foreach ($customer_groups as $customer_group) { ?>
			html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['name']); ?></option>';
			<?php } ?>
			html += '  </select></td>';
			html += '  <td class="text-right"><input type="text" name="news_special[' + special_row + '][priority]" value="" placeholder="<?php echo $entry_priority; ?>" class="form-control" /></td>';
			html += '  <td class="text-right"><input type="text" name="news_special[' + special_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="news_special[' + special_row + '][date_start]" value="" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="news_special[' + special_row + '][date_end]" value="" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#special tbody').append(html);

			$('.date').datetimepicker({
				pickTime: false
			});

			special_row++;
		}
		//--></script>
	<script type="text/javascript"><!--
		var image_row = <?php echo $image_row; ?>;

		function addImage(){
			html = '<tr id="image-row' + image_row + '">';
			html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="news_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
			html += '  <td class="text-right"><input type="text" name="news_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

			$('#images tbody').append(html);

			image_row++;
		}
		//--></script>
	<script type="text/javascript"><!--
		var recurring_row = <?php echo $recurring_row; ?>;

		function addRecurring(){
			recurring_row++;

			html = '';
			html += '<tr id="recurring-row' + recurring_row + '">';
			html += '  <td class="left">';
			html += '    <select name="news_recurring[' + recurring_row + '][recurring_id]" class="form-control">>';
			<?php foreach ($recurrings as $recurring) { ?>
			html += '      <option value="<?php echo $recurring['recurring_id']; ?>"><?php echo $recurring['name']; ?></option>';
			<?php } ?>
			html += '    </select>';
			html += '  </td>';
			html += '  <td class="left">';
			html += '    <select name="news_recurring[' + recurring_row + '][customer_group_id]" class="form-control">>';
			<?php foreach ($customer_groups as $customer_group) { ?>
			html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
			<?php } ?>
			html += '    <select>';
			html += '  </td>';
			html += '  <td class="left">';
			html += '    <a onclick="$(\'#recurring-row' + recurring_row + '\').remove()" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></a>';
			html += '  </td>';
			html += '</tr>';

			$('#tab-recurring table tbody').append(html);
		}
		//--></script>
	<script type="text/javascript"><!--
		$('.date').datetimepicker({
			pickTime: false
		});

		$('.time').datetimepicker({
			pickDate: false
		});

		$('.datetime').datetimepicker({
			pickDate: true,
			pickTime: true
		});
		//--></script>
	<script type="text/javascript"><!--
		$('#language a:first').tab('show');
		$('#option a:first').tab('show');
		//--></script>
</div>
<?php echo $footer; ?>
