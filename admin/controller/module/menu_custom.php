<?php
class ControllerModuleMenuCustom extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/menu_custom');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('menu_custom', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_menu_group'] = $this->language->get('entry_menu_group');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/menu_custom', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('module/menu_custom', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);

		if (isset($this->request->post['menu_custom_status'])) {
			$data['menu_custom_status'] = $this->request->post['menu_custom_status'];
		} else {
			$data['menu_custom_status'] = $this->config->get('menu_custom_status');
		}

		if (isset($this->request->post['menu_custom_menu_group'])) {
			$data['menu_custom_menu_group'] = $this->request->post['menu_custom_menu_group'];
		} else {
			$data['menu_custom_menu_group'] = $this->config->get('menu_custom_menu_group');
		}

		$this->load->model('menu/menu_group');

		$data['menu_groups'] = array();

		$results = $this->model_menu_menu_group->getListMenus();

		if(!empty($results)) foreach ($results as $result) {
			$data['menu_groups'][] = array(
				'menu_group_id' => $result['menu_group_id'],
				'name'          => $result['name']
			);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/menu_custom', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/menu_custom')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}