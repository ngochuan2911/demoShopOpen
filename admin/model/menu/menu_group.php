<?php

class ModelMenuMenuGroup extends Model
{
	public function addMenuGroup($data) {
		//$this->event->trigger('pre.admin.add.menu_group', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "menu_group SET sort_order = '" . (int)$data['sort_order'] . "'");

		$menu_group_id = $this->db->getLastId();

		foreach ($data['menu_group_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_group_description SET menu_group_id = '" . (int)$menu_group_id . "', language_id = '" . (int)$language_id . "', description = '" . $this->db->escape($value['description']) . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		//$this->event->trigger('post.admin.add.menu_group', $menu_group_id);

		return $menu_group_id;
	}

	public function editMenuGroup($menu_group_id, $data) {
		//$this->event->trigger('pre.admin.edit.menu_group', $data);

		$this->db->query("UPDATE `" . DB_PREFIX . "menu_group` SET sort_order = '" . (int)$data['sort_order'] . "' WHERE menu_group_id = '" . (int)$menu_group_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_group_description WHERE menu_group_id = '" . (int)$menu_group_id . "'");

		foreach ($data['menu_group_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_group_description SET menu_group_id = '" . (int)$menu_group_id . "', language_id = '" . (int)$language_id . "', description = '" . $this->db->escape($value['description']) . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		//$this->event->trigger('post.admin.edit.menu_group', $menu_group_id);
	}

	public function getListMenus(){
		$query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX."menu_group mg LEFT JOIN ".DB_PREFIX."menu_group_description mgd ON(mg.menu_group_id = mgd.menu_group_id) WHERE mgd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;
	}

	public function getMenus($parent_id = 0, $menu_group_id) {
		$query = $this->db->query("SELECT m.*, mt.menu_type_id, mt.name, mt.route FROM " . DB_PREFIX . "menu m LEFT JOIN " . DB_PREFIX . "menu_type mt ON (m.menu_type_id = mt.menu_type_id) WHERE m.parent_id = '" . (int)$parent_id . "' AND m.menu_group_id = '" . (int)$menu_group_id . "' ORDER BY m.column, m.sort_order ASC");

		$menu_data = array();

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

	public function getPath($menu_id) {
		$query = $this->db->query("SELECT name_id, menu_type_id, parent_id FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "' ORDER BY `column`, sort_order ASC");
		$this->load->model('menu/menu_type');
		$query_menu_type = $this->model_menu_menu_type->getMenuType($query->row['menu_type_id']);
		switch ($query_menu_type['route']) {
			case 'cat_news':
				$this->load->model('news/category');
				$result = $this->model_news_category->getCategory($query->row['name_id']);
				if($query->row['parent_id']) {
					return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
				} else {
					return $result['name'];
				}
				break;
			case 'news':
				$this->load->model('news/news');
				$result = $this->model_news_news->getNews($query->row['name_id']);
				if($query->row['parent_id']) {
					return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
				} else {
					return $result['name'];
				}
				break;
			case 'category':
				$this->load->model('catalog/category');
				$result = $this->model_catalog_category->getCategory($query->row['name_id']);
				if($query->row['parent_id']) {
					return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
				} else {
					return $result['name'];
				}
				break;
			case 'product':
				$this->load->model('catalog/product');
				$result = $this->model_catalog_product->getProduct($query->row['name_id']);
				if($query->row['parent_id']) {
					return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $result['name'];
				} else {
					return $result['name'];
				}
				break;
			case 'internal':
				$this->load->model('menu/link_internal');
				$result_description = $this->model_menu_link_internal->getLinkInternalDescriptions($query->row['name_id']);
				$name = $result_description[(int)$this->config->get('config_language_id')]['name'];
				if($query->row['parent_id']) {
					return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $name;
				} else {
					return $name;
				}
				break;
			case 'external':
				$this->load->model('menu/link_external');
				$result_description = $this->model_menu_link_external->getLinkExternalDescriptions($query->row['name_id']);
				$name = $result_description[(int)$this->config->get('config_language_id')]['name'];
				if($query->row['parent_id']) {
					return $this->getPath($query->row['parent_id']) . $this->language->get('text_separator') . $name;
				} else {
					return $name;
				}
				break;
			default:
				return $query->row['name_id'];
				break;
		}
	}

	public function getMenuGroupDescriptions($menu_group_id) {
		$menu_group_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_group_description WHERE menu_group_id = '" . (int)$menu_group_id . "'");

		foreach ($query->rows as $result) {
			$menu_group_data[$result['language_id']] = array(
				'name' => $result['name'],
				'description' => $result['description'],
			);
		}

		return $menu_group_data;
	}

	public function getMenuGroup($menu_group_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_group mg LEFT JOIN " . DB_PREFIX . "menu_group_description mgd ON (mg.menu_group_id = mgd.menu_group_id) WHERE mg.menu_group_id = '" . (int)$menu_group_id . "' AND mgd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function deleteMenuGroup($menu_group_id) {
		//$this->event->trigger('pre.admin.delete.menu_group', $menu_group_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_group WHERE menu_group_id = '" . (int)$menu_group_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_group_description WHERE menu_group_id = '" . (int)$menu_group_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu WHERE menu_group_id = '" . (int)$menu_group_id . "'");
		//$this->event->trigger('post.admin.delete.menu_group', $menu_group_id);
	}
}

?>