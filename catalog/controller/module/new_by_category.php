<?php
class ControllerModuleNewByCategory extends Controller {
	public function index($setting) {
		$this->load->language('module/new_by_category');

		$this->load->model('news/category');

		$category_info = $this->model_news_category->getCategory($setting['category_id']);

		$data['heading_title'] = $category_info['name'];
		$data['category_link'] = $this->url->link('news/category', 'cat_news_id=' . $setting['category_id']);

		$this->load->model('news/news');

		$this->load->model('tool/image');

		$data['config_social_facebook'] = html_entity_decode($this->config->get('config_social_facebook'));

		$data['newss'] = array();

		$filter_data = array(
			'filter_category_id'  => $setting['category_id'],
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_news_news->getNewss($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'], 'resize_and_crop');
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height'], 'resize_and_crop');
				}

				$data['newss'][] = array(
					'news_id'     => $result['news_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_news_description_length')) . '..',
					'description_short' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 120) . '..',
					'href'        => $this->url->link('news/news', 'cat_news_id=' . $setting['category_id'] . '&news_id=' . $result['news_id'] . '')
				);
			}

			return $this->load->view('module/new_by_category', $data);
		}
	}
}
