<?php

class ModelDesignUrlAlias extends Model
{
	public function addUrlAlias($data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias_web SET route = '" . $this->db->escape($data['route']) . "', url_alias = '" . $this->db->escape($data['url_alias']) . "'");
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = '" . $this->db->escape($data['route']) . "', keyword = '" . $this->db->escape($data['url_alias']) . "'");
	}

	public function editUrlAlias($url_alias_web_id, $data)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = '" . $this->db->escape($data['route']) . "'");

		$this->db->query("UPDATE " . DB_PREFIX . "url_alias_web SET route = '" . $this->db->escape($data['route']) . "', url_alias = '" . $this->db->escape($data['url_alias']) . "' WHERE url_alias_web_id = '" . (int)$url_alias_web_id . "'");
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = '" . $this->db->escape($data['route']) . "', keyword = '" . $this->db->escape($data['url_alias']) . "'");
	}

	public function deleteUrlAlias($url_alias_web_id)
	{
		$data = $this->getUrlAlias($url_alias_web_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias_web WHERE url_alias_web_id = '" . (int)$url_alias_web_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = '" . $this->db->escape($data['route']) . "'");
	}

	public function getUrlAlias($url_alias_web_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "url_alias_web WHERE url_alias_web_id = '" . (int)$url_alias_web_id . "'");

		return $query->row;
	}

	public function getUrlAliass($data = array())
	{
		$sql = "SELECT * FROM " . DB_PREFIX . "url_alias_web";

		$sort_data = array('route');

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY route";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

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

	public function getTotalUrlAliass()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "url_alias_web");

		return $query->row['total'];
	}
}

?>