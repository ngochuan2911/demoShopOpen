<?php
class ModelNewsNews extends Model {
	public function addNews($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$news_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}

		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['news_store'])) {
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['news_image'])) {
			foreach ($data['news_image'] as $news_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_image SET news_id = '" . (int)$news_id . "', image = '" . $this->db->escape($news_image['image']) . "', sort_order = '" . (int)$news_image['sort_order'] . "'");
			}
		}

		if (isset($data['news_download'])) {
			foreach ($data['news_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_download SET news_id = '" . (int)$news_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		if (isset($data['news_category'])) {
			foreach ($data['news_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_category SET news_id = '" . (int)$news_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
		
		if (isset($data['news_layout'])) {
			foreach ($data['news_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_layout SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('news');

		return $news_id;
	}

	public function editNews($news_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");

		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_store'])) {
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_image WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_image'])) {
			foreach ($data['news_image'] as $news_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_image SET news_id = '" . (int)$news_id . "', image = '" . $this->db->escape($news_image['image']) . "', sort_order = '" . (int)$news_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_download WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_download'])) {
			foreach ($data['news_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_download SET news_id = '" . (int)$news_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_category'])) {
			foreach ($data['news_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_category SET news_id = '" . (int)$news_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_layout'])) {
			foreach ($data['news_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_layout SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('news');
	}

	public function copyNews($news_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "news p WHERE p.news_id = '" . (int)$news_id . "'");

		if ($query->num_rows) {
			$data = $query->row;

			$data['viewed'] = '0';
			$data['keyword'] = '';

			$data['news_description'] = $this->getNewsDescriptions($news_id);
			$data['news_image'] = $this->getNewsImages($news_id);
			$data['news_category'] = $this->getNewsCategories($news_id);
			$data['news_download'] = $this->getNewsDownloads($news_id);
			$data['news_layout'] = $this->getNewsLayouts($news_id);
			$data['news_store'] = $this->getNewsStores($news_id);

			$this->addNews($data);
		}
	}

	public function deleteNews($news_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_image WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_download WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "comment WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "'");

		$this->cache->delete('news');
	}

	public function getNews($news_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "') AS keyword FROM " . DB_PREFIX . "news p LEFT JOIN " . DB_PREFIX . "news_description pd ON (p.news_id = pd.news_id) WHERE p.news_id = '" . (int)$news_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getNewss($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "news p LEFT JOIN " . DB_PREFIX . "news_description pd ON (p.news_id = pd.news_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$sql .= " GROUP BY p.news_id";

		$sort_data = array(
			'pd.name',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.name";
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
				$data['limit'] = 1000;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getNewssByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news p LEFT JOIN " . DB_PREFIX . "news_description pd ON (p.news_id = pd.news_id) LEFT JOIN " . DB_PREFIX . "news_to_category p2c ON (p.news_id = p2c.news_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	public function getNewsDescriptions($news_id) {
		$news_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");

		foreach ($query->rows as $result) {
			$news_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $news_description_data;
	}

	public function getNewsCategories($news_id) {
		$news_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");

		foreach ($query->rows as $result) {
			$news_category_data[] = $result['category_id'];
		}

		return $news_category_data;
	}

	public function getNewsImages($news_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_image WHERE news_id = '" . (int)$news_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getNewsDownloads($news_id) {
		$news_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_download WHERE news_id = '" . (int)$news_id . "'");

		foreach ($query->rows as $result) {
			$news_download_data[] = $result['download_id'];
		}

		return $news_download_data;
	}

	public function getNewsStores($news_id) {
		$news_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");

		foreach ($query->rows as $result) {
			$news_store_data[] = $result['store_id'];
		}

		return $news_store_data;
	}

	public function getNewsLayouts($news_id) {
		$news_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");

		foreach ($query->rows as $result) {
			$news_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $news_layout_data;
	}

	public function getTotalNewss($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.news_id) AS total FROM " . DB_PREFIX . "news p LEFT JOIN " . DB_PREFIX . "news_description pd ON (p.news_id = pd.news_id)";

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalNewssByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_to_download WHERE download_id = '" . (int)$download_id . "'");

		return $query->row['total'];
	}

	public function getTotalNewssByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}

	public function getNewsMax() {
		$query = $this->db->query("SELECT news_id FROM " . DB_PREFIX . "news ORDER BY news_id DESC LIMIT 0,1");

		return $query->row;
	}
}
