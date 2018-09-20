<?php

class ModelMenuLinkInternal extends Model
{
	public function addLinkInternal($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "link_internal SET route = '" . $this->db->escape($data['route']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "'");

		$link_internal_id = $this->db->getLastId();

		foreach ($data['link_internal_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "link_internal_description SET link_internal_id = '" . (int)$link_internal_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function editLinkInternal($link_internal_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "link_internal SET route = '" . $this->db->escape($data['route']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE link_internal_id = '" . (int)$link_internal_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "link_internal_description WHERE link_internal_id = '" . (int)$link_internal_id . "'");

		foreach ($data['link_internal_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "link_internal_description SET link_internal_id = '" . (int)$link_internal_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function deleteLinkInternal($link_internal_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "link_internal WHERE link_internal_id = '" . (int)$link_internal_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "link_internal_description WHERE link_internal_id = '" . (int)$link_internal_id . "'");
	}

	public function updateLinkInternalStatus($link_internal_id, $status) {
		$this->db->query("UPDATE " . DB_PREFIX . "link_internal SET status = '" . (int)$status . "' WHERE link_internal_id = '" . (int)$link_internal_id . "'");
	}

	public function getLinkInternal($link_internal_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "link_internal WHERE link_internal_id = '" . (int)$link_internal_id . "'");

		return $query->row;
	}

	public function getLinkInternals($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "link_internal li LEFT JOIN " . DB_PREFIX . "link_internal_description lid ON (li.link_internal_id = lid.link_internal_id) WHERE lid.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sort_data = array(
			'lid.name',
			'li.sort_order'
		);

		if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY lid.name";
		}

		if(isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if(isset($data['start']) || isset($data['limit'])) {
			if($data['start'] < 0) {
				$data['start'] = 0;
			}

			if($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getLinkInternalDescriptions($link_internal_id) {
		$attribute_group_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "link_internal_description WHERE link_internal_id = '" . (int)$link_internal_id . "'");

		foreach ($query->rows as $result) {
			$attribute_group_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $attribute_group_data;
	}

	public function getTotalLinkInternals() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "link_internal");

		return $query->row['total'];
	}

	public function checkInternalInMenu($link_internal_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_type WHERE route = 'internal'");
		$menu_type_id = $query->row['menu_type_id'];

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu WHERE name_id = " . (int)$link_internal_id . " AND menu_type_id = " . (int)$menu_type_id);
		if($query->row['total'] == 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>