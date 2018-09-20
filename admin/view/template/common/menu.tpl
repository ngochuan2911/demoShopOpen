<ul id="menu">
	<li id="dashboard"><a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i> <span><?php echo $text_dashboard; ?></span></a></li>
	<li id="catalog"><a class="parent"><i class="fa fa-tags fa-fw"></i> <span><?php echo $text_catalog; ?></span></a>
		<ul>
			<li><a href="<?php echo $category; ?>"><?php echo $text_category; ?></a></li>
			<li><a href="<?php echo $product; ?>"><?php echo $text_product; ?></a></li>
			<li><a href="<?php echo $filter; ?>"><?php echo $text_filter; ?></a></li>
			<li><a class="parent"><?php echo $text_attribute; ?></a>
				<ul>
					<li><a href="<?php echo $attribute; ?>"><?php echo $text_attribute; ?></a></li>
					<li><a href="<?php echo $attribute_group; ?>"><?php echo $text_attribute_group; ?></a></li>
				</ul>
			</li>
			<li><a href="<?php echo $option; ?>"><?php echo $text_option; ?></a></li>
			<li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
			<li><a href="<?php echo $review; ?>"><?php echo $text_review; ?></a></li>
		</ul>
	</li>
	<li id="news"><a class="parent"><i class="fa fa-newspaper-o fa-fw"></i> <span><?php echo $text_news; ?></span></a>
		<ul>
			<li><a href="<?php echo $cat_news; ?>"><?php echo $text_category; ?></a></li>
			<li><a href="<?php echo $news; ?>"><?php echo $text_news; ?></a></li>
			<li><a href="<?php echo $comment; ?>"><?php echo $text_comment; ?></a></li>
			<li><a href="<?php echo $information; ?>"><?php echo $text_information; ?></a></li>
		</ul>
	</li>
	<li id="extension"><a class="parent"><i class="fa fa-puzzle-piece fa-fw"></i> <span><?php echo $text_extension; ?></span></a>
		<ul>
			<li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
			<li><a href="<?php echo $theme; ?>"><?php echo $text_theme; ?></a></li>
			<li><a href="<?php echo $analytics; ?>"><?php echo $text_analytics; ?></a></li>
		</ul>
	</li>
	<li id="design"><a class="parent"><i class="fa fa-television fa-fw"></i> <span><?php echo $text_design; ?></span></a>
		<ul>
			<li><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
			<li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
			<li><a href="<?php echo $url_alias; ?>"><?php echo $text_url_alias; ?></a></li>
		</ul>
	</li>
	<li id="sale"><a class="parent"><i class="fa fa-shopping-cart fa-fw"></i> <span><?php echo $text_sale; ?></span></a>
		<ul>
			<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
		</ul>
	</li>
	<li><a class="parent"><i class="fa fa-share-alt fa-fw"></i> <span><?php echo $text_marketing; ?></span></a>
		<ul>
			<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
			<li><a href="<?php echo $lienhe; ?>"><?php echo $text_contact_form; ?></a></li>
			<li><a href="<?php echo $newsletters; ?>"><?php echo $text_newsletters; ?></a></li>
		</ul>
	</li>
	<li id="tools"><a class="parent"><i class="fa fa-code-fork fa-fw"></i> <span><?php echo $text_tools; ?></span></a>
		<ul>
			<li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
			<li><a href="<?php echo $upload; ?>"><?php echo $text_upload; ?></a></li>
			<li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
			<li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
		</ul>
	</li>
	<li id="menu"><a class="parent"><i class="fa fa-sitemap fa-fw"></i> <span><?php echo $text_menu; ?></span></a>
		<ul>
			<li><a href="<?php echo $menu_group; ?>"><?php echo $text_menu_group; ?></a></li>
			<li><a href="<?php echo $internal; ?>"><?php echo $text_internal; ?></a></li>
			<li><a href="<?php echo $external; ?>"><?php echo $text_external; ?></a></li>
		</ul>
	</li>
	<li id="system"><a class="parent"><i class="fa fa-cog fa-fw"></i> <span><?php echo $text_system; ?></span></a>
		<ul>
			<li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
			<li><a class="parent"><?php echo $text_users; ?></a>
				<ul>
					<li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
					<li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
					<li><a href="<?php echo $api; ?>"><?php echo $text_api; ?></a></li>
				</ul>
			</li>
			<li><a class="parent"><?php echo $text_localisation; ?></a>
				<ul>
					<li><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li id="reports"><a class="parent"><i class="fa fa-bar-chart-o fa-fw"></i> <span><?php echo $text_reports; ?></span></a>
		<ul>
			<li><a class="parent"><?php echo $text_sale; ?></a>
				<ul>
					<li><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
				</ul>
			</li>
			<li><a class="parent"><?php echo $text_product; ?></a>
				<ul>
					<li><a href="<?php echo $report_product_viewed; ?>"><?php echo $text_report_product_viewed; ?></a></li>
					<li><a href="<?php echo $report_product_purchased; ?>"><?php echo $text_report_product_purchased; ?></a></li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
