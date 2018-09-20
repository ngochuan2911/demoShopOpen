<?php

class ModelMarketingLienhe extends Model
{
	public function deleteLienhe($lienhe_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "lienhe WHERE lienhe_id = '" . (int)$lienhe_id . "'");

	}

	public function updateLienheViewed($lienhe_id)
	{
		$this->db->query("UPDATE " . DB_PREFIX . "lienhe SET viewed = 1 WHERE lienhe_id = '" . (int)$lienhe_id . "'");
	}

	public function getLienhe($lienhe_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "lienhe WHERE lienhe_id = '" . (int)$lienhe_id . "'");

		return $query->row;
	}

	public function getLienhes($data = array())
	{
		$sql = "SELECT * FROM " . DB_PREFIX . "lienhe";

		$sort_data = array(
			'name',
			'email',
			'date_added'
		);

		if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY date_added";
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

	public function getTotalLienhes()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "lienhe");

		return $query->row['total'];
	}

	public function getTotalLienhesAwaitingApproval()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "lienhe WHERE status = '0'");

		return $query->row['total'];
	}

	public function getTotalLienhesAwaitingViewed()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "lienhe WHERE viewed = '0'");

		return $query->row['total'];
	}
}

?>