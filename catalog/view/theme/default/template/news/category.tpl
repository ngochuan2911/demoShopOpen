<?php echo $header; ?>
<?php echo $content_maintop; ?>
<div class="container">
	<div class="row" style="margin-top: 20px;"><?php echo $column_left; ?>
		<?php if($column_left && $column_right) { ?><?php $class = 'col-sm-6'; ?><?php } elseif($column_left || $column_right) { ?><?php $class = 'col-sm-9'; ?><?php } else { ?><?php $class = 'col-sm-12'; ?><?php } ?>
		<div id="content" class="<?php echo $class; ?>">
			<ul class="breadcrumb" style="background: none;">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
			<hr>
			<?php echo $content_top; ?>
			<h1 style="margin-bottom: 30px;"><?php echo $heading_title; ?></h1>
			<?php if($description) { ?>
				<div class="row">
					<?php if($description) { ?>
						<div class="col-sm-10"><?php echo $description; ?></div>
					<?php } ?>
				</div>
				<hr>
			<?php } ?>
			<div class="row" style="margin-bottom: 20px; line-height: 28px;">
				<div class="col-md-8 text-right">
					<label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
				</div>
				<div class="col-md-4 text-right">
					<select id="input-sort" class="form-control" onchange="location = this.value;">
						<?php foreach ($sorts as $sorts) { ?>
						<?php if ($sorts['value'] == $sort . '-' . $order) { ?>
						<option value="<?php echo $sorts['href']; ?>"
								selected="selected"><?php echo $sorts['text']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>
			<?php if($newss) { ?>
				<?php foreach ($newss as $news) { ?>
					<div class="row news-list">
						<div class="news-thumb col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom:10px;">
							<div class="image"><a href="<?php echo $news['href']; ?>"><img src="<?php echo $news['thumb']; ?>" alt="<?php echo $news['name']; ?>" title="<?php echo $news['name']; ?>" class="img-responsive img-thumbnail"/></a></div>
						</div>
						<div class="news-caption col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<h3><a href="<?php echo $news['href']; ?>"><?php echo $news['name']; ?></a></h3>
							<div class="date-added"><i class="fa fa-calendar"></i> <?php echo $news['date_added']; ?></div>
							<div class="description"><?php echo $news['description']; ?></div>
							<a href="<?php echo $news['href']; ?>" class="view-more"><?php echo $text_view_more; ?>...</a>
						</div>
					</div>
					<hr>
				<?php } ?>

				<div class="row">
					<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
					<div class="col-sm-6 text-right"><?php echo $results; ?></div>
				</div>
			<?php } ?>
			<?php if(!$categories && !$newss) { ?>
				<p><?php echo $text_empty; ?></p>
				<div class="buttons">
					<div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
				</div>
			<?php } ?>
			<?php echo $content_bottom; ?></div>
		<?php echo $column_right; ?></div></div>
<?php echo $content_mainbottom; ?>
<?php echo $footer; ?>
