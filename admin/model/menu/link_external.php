<?php

class ModelMenuLinkExternal extends Model
{
	public function addLinkExternal($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "link_external SET route = '" . $this->db->escape($data['route']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "'");

		$link_external_id = $this->db->getLastId();

		foreach ($data['link_external_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "link_external_description SET link_external_id = '" . (int)$link_external_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function editLinkExternal($link_external_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "link_external SET route = '" . $this->db->escape($data['route']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE link_external_id = '" . (int)$link_external_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "link_external_description WHERE link_external_id = '" . (int)$link_external_id . "'");

		foreach ($data['link_external_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "link_external_description SET link_external_id = '" . (int)$link_external_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function deleteLinkExternal($link_external_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "link_external WHERE link_external_id = '" . (int)$link_external_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "link_external_description WHERE link_external_id = '" . (int)$link_external_id . "'");
	}

	public function updateLinkExternalStatus($link_external_id, $status) {
		$this->db->query("UPDATE " . DB_PREFIX . "link_external SET status = '" . (int)$status . "' WHERE link_external_id = '" . (int)$link_external_id . "'");
	}

	public function getLinkExternal($link_external_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "link_external WHERE link_external_id = '" . (int)$link_external_id . "'");

		return $query->row;
	}

	public function getLinkExternals($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "link_external le LEFT JOIN " . DB_PREFIX . "link_external_description led ON (le.link_external_id = led.link_external_id) WHERE led.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sort_data = array(
			'led.name',
			'le.sort_order'
		);

		if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY led.name";
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

	public function getLinkExternalDescriptions($link_external_id) {
		$attribute_group_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "link_external_description WHERE link_external_id = '" . (int)$link_external_id . "'");

		foreach ($query->rows as $result) {
			$attribute_group_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $attribute_group_data;
	}

	public function getTotalLinkExternals() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "link_external");

		return $query->row['total'];
	}

	public function checkExternalInMenu($link_external_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_type WHERE route = 'external'");
		$menu_type_id = $query->row['menu_type_id'];

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu WHERE name_id = " . (int)$link_external_id . " AND menu_type_id = " . (int)$menu_type_id);
		if($query->row['total'] == 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>