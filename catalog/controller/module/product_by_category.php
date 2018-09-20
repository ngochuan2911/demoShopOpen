<?php
class ControllerModuleProductByCategory extends Controller {
	public function index($setting) {
		$this->load->language('module/product_by_category');

		$this->load->model('catalog/category');
		$this->load->model('catalog/category');
		$this->load->model('tool/image');

		$category_info = $this->model_catalog_category->getCategory($setting['category_id']);

		$data['heading_title'] = $category_info['name'];
		$data['category_link'] = $this->url->link('product/category', 'path=' . $setting['category_id']);
		$data['category_image'] = $this->model_tool_image->resize($category_info['image'], 322, 228, 'resize_and_crop');

		/*$categories = $this->model_catalog_category->getCategories($setting['category_id']);

		foreach ($categories as $category) {
			$children_data = array();

			$children = $this->model_catalog_category->getCategories($category['category_id']);

			foreach($children as $child) {
				$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
				);
			}

			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
			);
		}*/

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$data['text_view_all'] = $this->language->get('text_view_all');

		$data['color'] = $setting['color'];

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		$filter_data = array(
			'filter_category_id'  => $setting['category_id'],
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProducts($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'], 'resize_and_crop');
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height'], 'resize_and_crop');
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$percent = cal_percent($result['price'], $result['special']);
				} else {
					$special = false;
					$percent = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'demo'        => utf8_substr(strip_tags(html_entity_decode($result['demo'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..',
					'price'       => $price,
					'special'     => $special,
					'percent'     => $percent,
					'new'         => $result['new'],
					'compare'     => $result['compare'],
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'path=' . $setting['category_id'] . '&product_id=' . $result['product_id'])
				);
			}

			return $this->load->view('module/product_by_category', $data);
		}
	}
}
