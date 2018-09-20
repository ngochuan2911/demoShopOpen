<?php
class ControllerModuleFacebookPage extends Controller {
	public function index() {
		$this->load->language('module/facebook_page');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['config_social_facebook'] = $this->config->get('config_social_facebook');

		return $this->load->view('module/facebook_page', $data);
	}
}