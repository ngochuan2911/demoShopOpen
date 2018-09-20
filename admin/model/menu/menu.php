<?php

class ModelMenuMenu extends Model
{
	public function addMenu($data, $menu_group_id)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "menu SET name_id = '" . (int)$data['name_id'] . "', menu_group_id = '" . (int)$menu_group_id . "', menu_type_id = '" . (int)$data['menu_type_id'] . "', parent_id = '" . (int)$data['parent_id'] . "', image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$menu_id = $this->db->getLastId();

		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		return $menu_id;
	}

	public function editMenu($menu_id, $data, $menu_group_id)
	{
		$this->db->query("UPDATE " . DB_PREFIX . "menu SET name_id = '" . (int)$data['name_id'] . "', menu_type_id = '" . (int)$data['menu_type_id'] . "', parent_id = '" . (int)$data['parent_id'] . "', image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE menu_id = '" . (int)$menu_id . "' AND menu_group_id = '" . (int)$menu_group_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");

		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
	}

	public function deleteMenu($menu_id, $menu_group_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "' AND menu_group_id =".$menu_group_id);
	}

	public function updateMenuStatus($menu_id, $status)
	{
		$this->db->query("UPDATE " . DB_PREFIX . "menu SET status = '" . (int)$status . "' WHERE menu_id = '" . (int)$menu_id . "'");
	}

	public function getMenu($menu_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "'");

		return $query->row;
	}

	public function getMenuDescription($menu_id) {
		$menu_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");

		foreach ($query->rows as $result) {
			$menu_data[$result['language_id']] = array(
				'name' => $result['name'],
				'description' => $result['description']
			);
		}

		return $menu_data;
	}

	public function deleteMenuByNameId($name_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu WHERE name_id = '" . (int)$name_id . "'");
	}

	public function getMenuTypeByNameId($name_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu m LEFT JOIN " . DB_PREFIX . "menu_type mt ON (m.menu_type_id = mt.menu_type_id) WHERE m.name_id = '" . (int)$name_id . "' AND m.status = '1'");

		return $query->row;
	}

	public function getMenus($parent_id = 0, $menu_group_id)
	{
		$menu_data = array();

		$query = $this->db->query("SELECT m.*, mt.menu_type_id, mt.name, mt.route FROM " . DB_PREFIX . "menu m LEFT JOIN " . DB_PREFIX . "menu_type mt ON (m.menu_type_id = mt.menu_type_id) WHERE m.parent_id = '" . (int)$parent_id . "' AND m.menu_group_id = ".(int)$menu_group_id." ORDER BY m.sort_order, mt.name ASC");

		foreach ($query->rows as $result) {
			$menu_data[] = array(
				'menu_id'    => $result['menu_id'],
				'menu_type'  => $result['name'],
				'image'      => $result['image'],
				'route'      => $result['route'],
				'name_id'    => $this->getPath($result['menu_id']),
				'column'     => $result['column'],
				'sort_order' => $result['sort_order'],
				'status'     => $result['status']
			);

			$menu_data = array_merge($menu_data, $this->getMenus($result['menu_id'], $menu_group_id));
		}

		return $menu_data;
	}

	public function getPath($menu_id)
	{
		$query = $this->db->query("SELECT name_id, menu_type_id, parent_id FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "' ORDER BY sort_order ASC");
		$this->load->model('menu/menu_type');
		$query_menu_type = $this->model_menu_menu_type->getMenuType($query->row['menu_type_id']);
		if($query_menu_type['route'] == 'cat_news') {
			$this->load->model('news/category');
			$result = $this->model_news_category->getCategory($query->row['name_id']);
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
			} else {
				return $result['name'];
			}
		} elseif($query_menu_type['route'] == 'news') {
			$this->load->model('news/news');
			$result = $this->model_news_news->getNews($query->row['name_id']);
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
			} else {
				return $result['name'];
			}
		} elseif($query_menu_type['route'] == 'cat_product') {
			$this->load->model('catalog/category');
			$result = $this->model_catalog_category->getCategory($query->row['name_id']);
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
			} else {
				return $result['name'];
			}
		} elseif($query_menu_type['route'] == 'product') {
			$this->load->model('catalog/product');
			$result = $this->model_catalog_product->getProduct($query->row['name_id']);
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
			} else {
				return $result['name'];
			}
		} elseif($query_menu_type['route'] == 'category') {
			$this->load->model('catalog/category');
			$result = $this->model_catalog_category->getCategory($query->row['name_id']);
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
			} else {
				return $result['name'];
			}
		} elseif($query_menu_type['route'] == 'product') {
			$this->load->model('catalog/product');
			$result = $this->model_catalog_product->getProduct($query->row['name_id']);
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
			} else {
				return $result['name'];
			}
		} elseif($query_menu_type['route'] == 'internal') {
			$this->load->model('menu/link_internal');
			$result_description = $this->model_menu_link_internal->getLinkInternalDescriptions($query->row['name_id']);
			$name = $result_description[(int)$this->config->get('config_language_id')]['name'];
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $name;
			} else {
				return $name;
			}
		} elseif($query_menu_type['route'] == 'external') {
			$this->load->model('menu/link_external');
			$result_description = $this->model_menu_link_external->getLinkExternalDescriptions($query->row['name_id']);
			$name = $result_description[(int)$this->config->get('config_language_id')]['name'];
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $name;
			} else {
				return $name;
			}
		} elseif($query_menu_type['route'] == 'information') {
			$this->load->model('news/information');
			$result_description = $this->model_news_information->getInformationDescriptions($query->row['name_id']);
			$name = $result_description[(int)$this->config->get('config_language_id')]['title'];
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $name;
			} else {
				return $name;
			}
		} elseif($query_menu_type['route'] == 'manufacturer') {
			$this->load->model('catalog/manufacturer');
			$result_description = $this->model_catalog_manufacturer->getManufacturer($query->row['name_id']);
			$name = $result_description['name'];
			if($query->row['parent_id']) {
				return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $name;
			} else {
				return $name;
			}
		} else {
			return $query->row['name_id'];
		}
	}

	public function getTotalMenus()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu");

		return $query->row['total'];
	}
}

?>