<?php

class ModelMarketingNewsletter extends Model
{
	public function deleteNewsletter($newsletters_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "newsletters WHERE newsletters_id = '" . (int)$newsletters_id . "'");

	}

	public function getNewsletter($newsletters_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "newsletters WHERE newsletters_id = '" . (int)$newsletters_id . "'");

		return $query->row;
	}

	public function getNewsletters($data = array())
	{
		$sql = "SELECT * FROM " . DB_PREFIX . "newsletters";

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

	public function getTotalNewsletters()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "newsletters");

		return $query->row['total'];
	}

	public function getTotalNewslettersAwaitingApproval()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "newsletters WHERE status = '0'");

		return $query->row['total'];
	}

	public function getTotalNewslettersAwaitingViewed()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "newsletters WHERE viewed = '0'");

		return $query->row['total'];
	}
}

?>