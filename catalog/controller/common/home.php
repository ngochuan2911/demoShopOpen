<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

        $data['heading_title_home'] = $this->config->get('config_meta_title');
        $data['heading_title_home'] = $data['heading_title_home'][$this->config->get('config_language_id')];

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_maintop'] = $this->load->controller('common/content_maintop');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['content_mainbottom'] = $this->load->controller('common/content_mainbottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}