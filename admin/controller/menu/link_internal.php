<?php

class ControllerMenuLinkInternal extends Controller
{
	private $error = array();

	public function index() {
		$this->language->load('menu/link_internal');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/link_internal');

		$this->getList();
	}

	public function insert() {
		$this->language->load('menu/link_internal');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/link_internal');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_link_internal->addLinkInternal($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if(isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('menu/link_internal');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/link_internal');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_link_internal->editLinkInternal($this->request->get['link_internal_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if(isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('menu/link_internal');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/link_internal');

		if(isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $link_internal_id) {
				$this->model_menu_link_internal->deleteLinkInternal($link_internal_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if(isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if(isset($this->error['internal_in_menu'])) {
			$data['error_internal_in_menu'] = $this->error['internal_in_menu'];
		} else {
			$data['error_internal_in_menu'] = '';
		}

		if(isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'li.sort_order';
		}

		if(isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if(isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if(isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data_filter = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$link_internal_total = $this->model_menu_link_internal->getTotalLinkInternals();

		$results = $this->model_menu_link_internal->getLinkInternals($data_filter);

		$data['link_internals'] = array();

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('menu/link_internal/update', 'token=' . $this->session->data['token'] . '&link_internal_id=' . $result['link_internal_id'] . $url, 'SSL')
			);

			$data['link_internals'][] = array(
				'link_internal_id' => $result['link_internal_id'],
				'name'             => $result['name'],
				'route'            => $result['route'],
				'status'           => $result['status'],
				'status_image'     => ($result['status'] ? 'view/image/enabled.png' : 'view/image/disabled.png'),
				'sort_order'       => $result['sort_order'],
				'selected'         => isset($this->request->post['selected']) && in_array($result['link_internal_id'], $this->request->post['selected']),
				'action'           => $action
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_route'] = $this->language->get('column_route');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_route'] = $this->language->get('column_route');

		$data['text_tooltip_enabled'] = $this->language->get('text_tooltip_enabled');
		$data['text_tooltip_disabled'] = $this->language->get('text_tooltip_disabled');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_delete'] = $this->language->get('button_delete');

		$data['token'] = $this->session->data['token'];

		if(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if(isset($this->session->data['success'])) {
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

		if($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['add'] = $this->url->link('menu/link_internal/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('menu/link_internal/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['sort_name'] = $this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . '&sort=agd.name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . '&sort=ag.sort_order' . $url, 'SSL');

		$url = '';

		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if(isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $link_internal_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($link_internal_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($link_internal_total - $this->config->get('config_limit_admin'))) ? $link_internal_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $link_internal_total, ceil($link_internal_total / $this->config->get('config_limit_admin')));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('menu/link_internal_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_route'] = $this->language->get('entry_route');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_form'] = $this->language->get('text_form');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if(isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		$url = '';

		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if(isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if(isset($this->request->get['page'])) {
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
			'href'      => $this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if(!isset($this->request->get['link_internal_id'])) {
			$data['action'] = $this->url->link('menu/link_internal/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('menu/link_internal/update', 'token=' . $this->session->data['token'] . '&link_internal_id=' . $this->request->get['link_internal_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('menu/link_internal', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if(isset($this->request->get['link_internal_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$link_internal_info = $this->model_menu_link_internal->getLinkInternal($this->request->get['link_internal_id']);
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if(isset($this->request->post['link_internal_description'])) {
			$data['link_internal_description'] = $this->request->post['link_internal_description'];
		} elseif(isset($this->request->get['link_internal_id'])) {
			$data['link_internal_description'] = $this->model_menu_link_internal->getLinkInternalDescriptions($this->request->get['link_internal_id']);
		} else {
			$data['link_internal_description'] = array();
		}

		if(isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif(!empty($link_internal_info)) {
			$data['sort_order'] = $link_internal_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if(isset($this->request->post['route'])) {
			$data['route'] = $this->request->post['route'];
		} elseif(!empty($link_internal_info)) {
			$data['route'] = $link_internal_info['route'];
		} else {
			$data['route'] = '';
		}

		if(isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif(!empty($link_internal_info)) {
			$data['status'] = $link_internal_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('menu/link_internal_form', $data));
	}

	protected function validateForm() {
		if(!$this->user->hasPermission('modify', 'menu/link_internal')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['link_internal_description'] as $language_id => $value) {
			if((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if(!$this->user->hasPermission('modify', 'menu/link_internal')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('menu/link_internal');
		if(!empty($this->request->post['selected']))
			foreach ($this->request->post['selected'] as $link_internal_id) {
				if($this->model_menu_link_internal->checkInternalInMenu($link_internal_id) == false) {
					$this->error['internal_in_menu'] = $this->language->get('error_internal_in_menu');
				}
			}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function ajaxed() {
		//sleep(1);
		$json = array();
		if(isset($this->request->post['link_internal_id']) || isset($this->request->post['status'])) {
			if(isset($this->request->post['link_internal_id'])) {
				$link_internal_id = $this->request->post['link_internal_id'];
			} else {
				$json['error'] = true;
			}

			if(isset($this->request->post['status'])) {
				$status = $this->request->post['status'];
				$convert = $status ? 0 : 1;
			} else {
				$json['error'] = true;
			}
			if(!isset($json['error'])) {
				$this->load->model('menu/link_internal');
				$this->model_menu_link_internal->updateLinkInternalStatus($link_internal_id, $convert);
				$json['success'] = true;
				$json['status'] = $convert;
			}
		}
		$this->response->setOutput(json_encode($json));
	}
}

?>