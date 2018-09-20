<?php

class ModelMenuMenuType extends Model
{
	public function addMenuType($data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "menu_type SET name = '" . $this->db->escape($data['name']) . "', route = '" . $this->db->escape($data['route']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
	}

	public function editMenuType($menu_type_id, $data)
	{
		$this->db->query("UPDATE " . DB_PREFIX . "menu_type SET name = '" . $this->db->escape($data['name']) . "', route = '" . $this->db->escape($data['route']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE menu_type_id = '" . (int)$menu_type_id . "'");
	}

	public function deleteMenuType($menu_type_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_type WHERE menu_type_id = '" . (int)$menu_type_id . "'");
	}

	public function updateMenuTypeStatus($menu_type_id, $status)
	{
		$this->db->query("UPDATE " . DB_PREFIX . "menu_type SET status = '" . (int)$status . "' WHERE menu_type_id = '" . (int)$menu_type_id . "'");
	}

	public function getMenuType($menu_type_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu_type WHERE menu_type_id = '" . (int)$menu_type_id . "'");

		return $query->row;
	}

	public function getMenuTypes($data = array(), $status = false)
	{
		$sql = "SELECT * FROM " . DB_PREFIX . "menu_type";

		if ($status) {
			$sql .= " WHERE status = 1";
		}
		$sql .= " ORDER BY sort_order";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalMenuTypes()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu_type");

		return $query->row['total'];
	}
}

?>