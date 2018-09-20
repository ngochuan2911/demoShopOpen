<?php
class ModelExtensionExtension extends Model {
	function getExtensions($type, $data) {
		$db = new DB($data['db_driver'], $data['db_hostname'], $data['db_username'], $data['db_password'], $data['db_database'], $data['db_port']);

		$query = $db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $db->escape($type) . "'");

		return $query->rows;
	}

	public function uninstall($type, $code, $data) {
		$db = new DB($data['db_driver'], $data['db_hostname'], $data['db_username'], $data['db_password'], $data['db_database'], $data['db_port']);

		$db->query("DELETE FROM " . DB_PREFIX . "extension WHERE `type` = '" . $db->escape($type) . "' AND `code` = '" . $db->escape($code) . "'");
		$db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = '" . $db->escape($code) . "'");
	}
}