<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->language->load('common/footer');

		$data['text_footer'] = $this->language->get('text_footer');

		return $this->load->view('common/footer', $data);
	}
}
