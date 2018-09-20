<?php

class ModelMenuMenu extends Model
{
	public function getMenu($menu_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "'");

		return $query->row;
	}

	public function getMenus($parent_id = 0, $menu_group_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu WHERE parent_id = '" . (int)$parent_id . "' AND menu_group_id = '" . (int)$menu_group_id . "' AND status = '1' ORDER BY `column`,sort_order ASC");

		return $query->rows;
	}

	public function getMenuType($menu_type_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu_type WHERE menu_type_id = '" . (int)$menu_type_id . "'");

		return $query->row;
	}

	public function getLinkInternal($link_internal_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "link_internal li LEFT JOIN " . DB_PREFIX . "link_internal_description lid ON (li.link_internal_id = lid.link_internal_id) WHERE li.link_internal_id = '" . (int)$link_internal_id . "' AND lid.language_id = '" . (int)$this->config->get('config_language_id') . "' AND li.status = '1'");

		return $query->row;
	}

	public function getLinkExternal($link_external_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "link_external le LEFT JOIN " . DB_PREFIX . "link_external_description led ON (le.link_external_id = led.link_external_id) WHERE le.link_external_id = '" . (int)$link_external_id . "' AND led.language_id = '" . (int)$this->config->get('config_language_id') . "' AND le.status = '1'");

		return $query->row;
	}

	public function getNoLink($no_link_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "no_link nl LEFT JOIN " . DB_PREFIX . "no_link_description nld ON (nl.no_link_id = nld.no_link_id) WHERE nl.no_link_id = '" . (int)$no_link_id . "' AND nld.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nl.status = '1'");

		return $query->row;
	}

	public function getTotalMenus() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu");

		return $query->row['total'];
	}

	public function getNameMenu($menu_id, $menu_type_id, $name_id) {
		$this->load->model('menu/menu');
		$this->load->model('news/category');
		$this->load->model('news/news');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('information/information');
		$this->load->model('catalog/manufacturer');

		$menu_type = $this->model_menu_menu->getMenuType($menu_type_id);


		$route = $menu_type['route'];

		$data = array();

		switch ($route) {
			case 'cat_news':
				$info = $this->model_news_category->getCategory($name_id);
				$name = $info['name'];
				$href = $this->url->link('news/category', 'cat_news_id=' . $name_id);
				$href = html_entity_decode($href);
				$attribute = '_self';
				break;
			case 'news':
				$info = $this->model_news_news->getNews($name_id);
				$name = $info['name'];
				$href = $this->url->link('news/news', 'news_id=' . $name_id);
				$href = html_entity_decode($href);
				$attribute = '_self';
				break;
			case 'cat_product':
				$info = $this->model_catalog_category->getCategory($name_id);
				if($info['parent_id'] == 0) {
					$href = $this->url->link('product/category', 'path=' . $name_id);
				} else {
					$href = $this->url->link('product/category', 'path=' . $info['parent_id'] . '_' . $name_id);
				}
				$href = html_entity_decode($href);
				$name = $info['name'];
				$attribute = '_self';
				break;
			case 'product':
				$info = $this->model_catalog_product->getProduct($name_id);
				$href = $this->url->link('product/product', 'product_id=' . $name_id);
				$href = html_entity_decode($href);
				$name = $info['name'];
				$attribute = '_self';
				break;
			case 'internal':
				$info = $this->model_menu_menu->getLinkInternal($name_id);
				$href = $this->url->link($info['route']);
				$href = html_entity_decode($href);
				$name = $info['name'];
				$attribute = '_self';
				break;
			case 'external':
				$info = $this->model_menu_menu->getLinkExternal($name_id);
				$href = $info['route'];
				$href = html_entity_decode($href);
				$name = $info['name'];
				$attribute = '_blank';
				break;
			case 'information':
				$info = $this->model_information_information->getInformation($name_id);
				$href = $this->url->link('information/information', 'information_id=' . $name_id);
				$href = html_entity_decode($href);
				$name = $info['title'];
				$attribute = '_self';
				break;
			case 'manufacturer':
				$info = $this->model_catalog_manufacturer->getManufacturer($name_id);
				$href = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $name_id);
				$href = html_entity_decode($href);
				$name = $info['name'];
				$attribute = '_self';
				break;
			default:
				$href = '';
				$name = '';
		}

		return $data[] = array(
			'menu_id'   => $menu_id,
			'name'      => isset($name) ? $name : '',
			'href'      => isset($href) ? $href : '',
			'attribute' => isset($attribute) ? $attribute : '',
		);
	}
}

?>