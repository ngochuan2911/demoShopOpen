<?php

class ControllerMenuMenuType extends Controller
{
	private $error = array();

	public function index()
	{
		$this->language->load('menu/menu_type');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_type');

		$this->getList();
	}

	public function insert()
	{
		$this->language->load('menu/menu_type');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_type');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_menu_type->addMenuType($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu_type', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update()
	{
		$this->language->load('menu/menu_type');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_type');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_menu_type->editMenuType($this->request->get['menu_type_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu_type', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete()
	{
		$this->language->load('menu/menu_type');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_type');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $menu_type_id) {
				$this->model_menu_menu_type->deleteMenuType($menu_type_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu_type', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList()
	{
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('menu/menu_type', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['insert'] = $this->url->link('menu/menu_type/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('menu/menu_type/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['menu_types'] = array();

		$data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$menu_type_total = $this->model_menu_menu_type->getTotalMenuTypes();

		$results = $this->model_menu_menu_type->getMenuTypes($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('menu/menu_type/update', 'token=' . $this->session->data['token'] . '&menu_type_id=' . $result['menu_type_id'] . $url, 'SSL')
			);

			$this->data['menu_types'][] = array(
				'menu_type_id' => $result['menu_type_id'],
				'name'         => $result['name'],
				'route'        => $result['route'],
				'sort_order'   => $result['sort_order'],
				'status'       => $result['status'],
				'status_image' => ($result['status'] ? 'view/image/enabled.png' : 'view/image/disabled.png'),
				'selected'     => isset($this->request->post['selected']) && in_array($result['menu_type_id'], $this->request->post['selected']),
				'action'       => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_route'] = $this->language->get('column_route');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['text_tooltip_enabled'] = $this->language->get('text_tooltip_enabled');
		$this->data['text_tooltip_disabled'] = $this->language->get('text_tooltip_disabled');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$pagination = new Pagination();
		$pagination->total = $menu_type_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('menu/menu_type', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->template = 'menu/menu_type_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm()
	{
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_enabled'] = $this->language->get('text_enabled');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_route'] = $this->language->get('entry_route');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_route'] = $this->language->get('button_add_route');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		if (isset($this->error['route'])) {
			$this->data['error_route'] = $this->error['route'];
		} else {
			$this->data['error_route'] = '';
		}

		$url = '';


		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('menu/menu_type', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['menu_type_id'])) {
			$this->data['action'] = $this->url->link('menu/menu_type/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('menu/menu_type/update', 'token=' . $this->session->data['token'] . '&menu_type_id=' . $this->request->get['menu_type_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('menu/menu_type', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['menu_type_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$menu_type_info = $this->model_menu_menu_type->getMenuType($this->request->get['menu_type_id']);
		}

		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} elseif (!empty($menu_type_info)) {
			$this->data['name'] = $menu_type_info['name'];
		} else {
			$this->data['name'] = '';
		}

		if (isset($this->request->post['route'])) {
			$this->data['route'] = $this->request->post['route'];
		} elseif (!empty($menu_type_info)) {
			$this->data['route'] = $menu_type_info['route'];
		} else {
			$this->data['route'] = '';
		}

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($menu_type_info)) {
			$this->data['sort_order'] = $menu_type_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($menu_type_info)) {
			$this->data['status'] = $menu_type_info['status'];
		} else {
			$this->data['status'] = '';
		}

		$this->template = 'menu/menu_type_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function validateForm()
	{
		if (!$this->user->hasPermission('modify', 'menu/menu_type')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['route']) < 3) || (utf8_strlen($this->request->post['route']) > 64)) {
			$this->error['route'] = $this->language->get('error_route');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete()
	{
		if (!$this->user->hasPermission('modify', 'menu/menu_type')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function ajaxed()
	{
		//sleep(1);
		$json = array();
		if (isset($this->request->post['menu_type_id']) || isset($this->request->post['status'])) {
			if (isset($this->request->post['menu_type_id'])) {
				$menu_type_id = $this->request->post['menu_type_id'];
			} else {
				$json['error'] = true;
			}

			if (isset($this->request->post['status'])) {
				$status = $this->request->post['status'];
				$convert = $status ? 0 : 1;
			} else {
				$json['error'] = true;
			}
			if (!isset($json['error'])) {
				$this->load->model('menu/menu_type');
				$this->model_menu_menu_type->updateMenuTypeStatus($menu_type_id, $convert);
				$json['success'] = true;
				$json['status'] = $convert;
			}
		}
		$this->response->setOutput(json_encode($json));
	}
}

?>