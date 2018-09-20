<?php

class ControllerDesignUrlAlias extends Controller
{
	private $error = array();

	public function index()
	{
		$this->language->load('design/url_alias');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/url_alias');

		$this->getList();
	}

	public function insert()
	{
		$this->language->load('design/url_alias');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/url_alias');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_url_alias->addUrlAlias($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/url_alias', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update()
	{
		$this->language->load('design/url_alias');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/url_alias');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {



			$this->model_design_url_alias->editUrlAlias($this->request->get['url_alias_web_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/url_alias', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete()
	{
		$this->language->load('design/url_alias');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/url_alias');

		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $url_alias_web_id) {
				$this->model_design_url_alias->deleteUrlAlias($url_alias_web_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/url_alias', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList()
	{
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'route';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('design/url_alias', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$data['add'] = $this->url->link('design/url_alias/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('design/url_alias/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['url_aliass'] = array();

		$data_filter = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$url_alias_total = $this->model_design_url_alias->getTotalUrlAliass();

		$results = $this->model_design_url_alias->getUrlAliass($data_filter);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('design/url_alias/update', 'token=' . $this->session->data['token'] . '&url_alias_web_id=' . $result['url_alias_web_id'] . $url, 'SSL')
			);

			$data['url_aliass'][] = array(
				'url_alias_web_id' => $result['url_alias_web_id'],
				'route'            => $result['route'],
				'url_alias'        => $result['url_alias'],
				'selected'         => isset($this->request->post['selected']) && in_array($result['url_alias_web_id'], $this->request->post['selected']),
				'action'           => $action
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_route'] = $this->language->get('column_route');
		$data['column_url_alias'] = $this->language->get('column_url_alias');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_name'] = $this->language->get('column_name');

		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('design/url_alias', 'token=' . $this->session->data['token'] . '&sort=route' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/url_alias_list', $data));
	}

	protected function getForm()
	{
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_default'] = $this->language->get('text_default');
		$data['text_form'] = $this->language->get('text_form');

		$data['entry_url_alias'] = $this->language->get('entry_url_alias');
		$data['entry_route'] = $this->language->get('entry_route');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_route'] = $this->language->get('button_add_route');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['route'])) {
			$data['error_route'] = $this->error['route'];
		} else {
			$data['error_route'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('design/url_alias', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['url_alias_web_id'])) {
			$data['action'] = $this->url->link('design/url_alias/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('design/url_alias/update', 'token=' . $this->session->data['token'] . '&url_alias_web_id=' . $this->request->get['url_alias_web_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('design/url_alias', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['url_alias_web_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$url_alias_info = $this->model_design_url_alias->getUrlAlias($this->request->get['url_alias_web_id']);
		}

		if (isset($this->request->post['route'])) {
			$data['route'] = $this->request->post['route'];
		} elseif (!empty($url_alias_info)) {
			$data['route'] = $url_alias_info['route'];
		} else {
			$data['route'] = '';
		}
		if (isset($this->request->post['url_alias'])) {
			$data['url_alias'] = $this->request->post['url_alias'];
		} elseif (!empty($url_alias_info)) {
			$data['url_alias'] = $url_alias_info['url_alias'];
		} else {
			$data['url_alias'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/url_alias_form', $data));
	}

	protected function validateForm()
	{
		if (!$this->user->hasPermission('modify', 'design/url_alias')) {
			$this->error['warning'] = $this->language->get('error_permission');
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
}

?>