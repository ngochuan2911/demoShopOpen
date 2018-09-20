<?php
class ModelExtensionModule extends Model {
	public function getModule($module_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE module_id = '" . (int)$module_id . "'");
		
		if ($query->row) {
			return json_decode($query->row['setting'], true);
		} else {
			return array();	
		}
	}

	public function deleteModulesByCode($code, $data) {
		$db = new DB($data['db_driver'], $data['db_hostname'], $data['db_username'], $data['db_password'], $data['db_database'], $data['db_port']);

		$db->query("DELETE FROM `" . DB_PREFIX . "module` WHERE `code` = '" . $db->escape($code) . "'");
		$db->query("DELETE FROM `" . DB_PREFIX . "layout_module` WHERE `code` LIKE '" . $db->escape($code) . "' OR `code` LIKE '" . $db->escape($code . '.%') . "'");
	}
}