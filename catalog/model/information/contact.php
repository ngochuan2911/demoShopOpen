<?php

class ModelInformationContact extends Model
{
	public function addContact($data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "lienhe SET name = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', enquiry = '" . $this->db->escape($data['enquiry']) . "', date_added = NOW()");
	}
}

?>