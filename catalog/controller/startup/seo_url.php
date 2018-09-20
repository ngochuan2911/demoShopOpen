<?php

class ControllerStartupSeoUrl extends Controller
{
	public function index()
	{
		// Add rewrite to url class
		if($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}

		// Decode URL
		if(isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);

			$route = "";

			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");

				if($query->num_rows) {
					$url = explode('=', $query->row['query']);

					if(count($url) > 1) {
						if($url[0] == 'product_id') {
							$this->request->get['product_id'] = $url[1];
						}

						if($url[0] == 'category_id') {
							if(!isset($this->request->get['path'])) {
								$this->request->get['path'] = $url[1];
							} else {
								$this->request->get['path'] .= '_' . $url[1];
							}
						}

						if($url[0] == 'manufacturer_id') {
							$this->request->get['manufacturer_id'] = $url[1];
						}

						if($url[0] == 'information_id') {
							$this->request->get['information_id'] = $url[1];
						}

						if($url[0] == 'news_id') {
							$this->request->get['news_id'] = $url[1];
						}

						if($url[0] == 'cat_news_id') {
							if(!isset($this->request->get['cat_news_id'])) {
								$this->request->get['cat_news_id'] = $url[1];
							} else {
								$this->request->get['cat_news_id'] .= '_' . $url[1];
							}
						}


						if($url[0] == 'path') {
							if(!isset($this->request->get['category_id'])) {
								$this->request->get['category_id'] = $url[1];
							} else {
								$this->request->get['category_id'] .= '_' . $url[1];
							}
						}
					} else {
						$route = $url[0];
					}
				} else {
					$this->request->get['route'] = 'error/not_found';
				}
			}

			if(isset($this->request->get['product_id'])) {
				$this->request->get['route'] = 'product/product';
			} elseif(isset($this->request->get['path'])) {
				$this->request->get['route'] = 'product/category';
			} elseif(isset($this->request->get['manufacturer_id'])) {
				$this->request->get['route'] = 'product/manufacturer/info';
			} elseif(isset($this->request->get['information_id'])) {
				$this->request->get['route'] = 'information/information';
			} elseif(isset($this->request->get['news_id'])) {
				$this->request->get['route'] = 'news/news';
			} elseif(isset($this->request->get['cat_news_id'])) {
				$this->request->get['route'] = 'news/category';
			} else {
				$this->request->get['route'] = $route;
			}
		}
	}

	public function rewrite($link)
	{
		if($this->config->get('config_seo_url')) {
			$url_info = parse_url(str_replace('&amp;', '&', $link));

			$url = '';

			$data = array();

			parse_str($url_info['query'], $data);

			foreach ($data as $key => $value) {
				if(isset($data['route'])) {
					if(($data['route'] = 'product/product' && $key == 'product_id') || ($data['route'] == 'information/information' && $key == 'information_id') || ($data['route'] = 'news/news' && $key == 'news_id')) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

						if($query->num_rows) {
							$url .= '/' . $query->row['keyword'];

							unset($data[$key]);
						}
					} elseif($key == 'path') {
						$categories = explode('_', $value);

						foreach ($categories as $category) {
							$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");

							if($query->num_rows) {
								$url .= '/' . $query->row['keyword'];
							}
						}

						unset($data[$key]);
					} elseif($key == 'product_id') {
						$products = explode('_', $value);

						foreach ($products as $product) {
							$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'product_id=" . (int)$product . "'");

							if($query->num_rows) {
								$url .= '/' . $query->row['keyword'];
							}
						}

						unset($data[$key]);
					} elseif($key == 'manufacturer_id') {
						$manufacturers = explode('_', $value);

						foreach ($manufacturers as $manufacturer) {
							$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'manufacturer_id=" . (int)$manufacturer . "'");

							if($query->num_rows) {
								$url .= '/' . $query->row['keyword'];
							}
						}

						unset($data[$key]);
					} elseif($key == 'information_id') {
						$informations = explode('_', $value);

						foreach ($informations as $information) {
							$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'information_id=" . (int)$information . "'");

							if($query->num_rows) {
								$url .= '/' . $query->row['keyword'];
							}
						}

						unset($data[$key]);
					} elseif($key == 'cat_news_id') {
						$cat_newss = explode('_', $value);

						foreach ($cat_newss as $cat_news) {
							$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'cat_news_id=" . (int)$cat_news . "'");

							if($query->num_rows) {
								$url .= '/' . $query->row['keyword'];
							}
						}

						unset($data[$key]);
					} elseif($key == 'route') {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($value) . "'");

						if($query->num_rows) {
							$url .= '/' . $query->row['keyword'];
							unset($data[$key]);
						}
					}
				}
			}

			if($url) {
				unset($data['route']);

				$query = '';

				if($data) {
					foreach ($data as $key => $value) {
						$query .= '&' . $key . '=' . $value;
					}

					if($query) {
						$query = '?' . trim($query, '&');
					}
				}

				return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
			} else {
				return $link;
			}
		} else {
			return $link;
		}
	}
}

?>