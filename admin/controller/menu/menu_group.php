<?php

class ControllerMenuMenuGroup extends Controller
{
	private $error = array();

	public function index() {
		$this->language->load('menu/menu_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_group');

		$this->getList();
	}

	public function insert() {
		$this->language->load('menu/menu_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_group');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_menu_group->addMenuGroup($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu_group', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('menu/menu_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_group');
		$this->load->model('menu/menu_type');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_menu_group->editMenuGroup($this->request->get['menu_group_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu_group', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('menu/menu_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu_group');

		if(isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $menu_group_id) {
				$this->model_menu_menu_group->deleteMenuGroup($menu_group_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu_group', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('menu/menu_group', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['add'] = $this->url->link('menu/menu_group/insert', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('menu/menu_group/delete', 'token=' . $this->session->data['token'], 'SSL');

		$data['menus'] = array();

		$results = $this->model_menu_menu_group->getListMenus();

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit_menu_detail'),
				'href' => $this->url->link('menu/menu', 'token=' . $this->session->data['token'] . '&menu_group_id=' . $result['menu_group_id'], 'SSL'),
				'icon' => 'fa fa-pencil-square-o'
			);

			$action[] = array(
				'text' => $this->language->get('text_edit_menu_info'),
				'href' => $this->url->link('menu/menu_group/update', 'token=' . $this->session->data['token'] . '&menu_group_id=' . $result['menu_group_id'], 'SSL'),
				'icon' => 'fa fa-info-circle'

			);

			$data['menus'][] = array(
				'menu_group_id' => $result['menu_group_id'],
				'sort_order'    => $result['sort_order'],
				'name'          => $result['name'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['menu_group_id'], $this->request->post['selected']),
				'action'        => $action
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_menu_type'] = $this->language->get('column_menu_type');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_column'] = $this->language->get('column_column');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['text_tooltip_enabled'] = $this->language->get('text_tooltip_enabled');
		$data['text_tooltip_disabled'] = $this->language->get('text_tooltip_disabled');

		$data['button_insert'] = $this->language->get('button_insert');
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

		if(isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('menu/menu_group_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_none'] = $this->language->get('text_none');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_enabled'] = $this->language->get('text_enabled');

		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['text_form'] = $this->language->get('text_form');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_menu_type'] = $this->language->get('entry_menu_type');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_group'] = $this->language->get('entry_group');
		$data['entry_group_description'] = $this->language->get('entry_group_description');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_route'] = $this->language->get('button_add_route');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['token'] = $this->session->data['token'];

		if(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if(isset($this->error['name_id'])) {
			$data['error_name_id'] = $this->error['name_id'];
		} else {
			$data['error_name_id'] = '';
		}

		if(isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		$url = '';

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
			'href'      => $this->url->link('menu/menu_group_form', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if(!isset($this->request->get['menu_group_id'])) {
			$data['action'] = $this->url->link('menu/menu_group/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('menu/menu_group/update', 'token=' . $this->session->data['token'] . '&menu_group_id=' . $this->request->get['menu_group_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('menu/menu_group', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if(isset($this->request->get['menu_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$menu_group_info = $this->model_menu_menu_group->getMenuGroup($this->request->get['menu_group_id']);
			$menu_group_id = $this->request->get['menu_group_id'];
		} else {
			$menu_group_id = 0;
		}

		$data['menus'] = array();

		$results = $this->model_menu_menu_group->getMenus(0, $menu_group_id);

		foreach($results as $result){
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('menu/menu_group/update_menu', 'token=' . $this->session->data['token'] . '&menu_group_id=' . $menu_group_id . '&menu_id=' . $result['menu_id'], 'SSL')
			);

			$data['menus'][] = array(
				'menu_id'    => $result['menu_id'],
				'image'      => $result['image'],
				'name_id'    => $result['name_id'],
				'menu_type'  => $result['menu_type'],
				'column'     => $result['column'],
				'sort_order' => $result['sort_order'],
				'status'     => $result['status'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['menu_id'], $this->request->post['selected']),
				'action'     => $action
			);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if(isset($this->request->post['menu_group_description'])) {
			$data['menu_group_description'] = $this->request->post['menu_group_description'];
		} elseif(isset($this->request->get['menu_group_id'])) {
			$data['menu_group_description'] = $this->model_menu_menu_group->getMenuGroupDescriptions($this->request->get['menu_group_id']);
		} else {
			$data['menu_group_description'] = array();
		}

		if(isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif(!empty($menu_group_info)) {
			$data['sort_order'] = $menu_group_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		$this->load->model('tool/image');
		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 50, 50);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('menu/menu_group_form', $data));
	}

	protected function validateForm() {
		if(!$this->user->hasPermission('modify', 'menu/menu_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['menu_group_description'] as $language_id => $value) {
			if((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 64)) {
				$this->error['name'][$language_id] = $this->language->get('error_group_name');
			}
		}

		if($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if(!$this->user->hasPermission('modify', 'menu/menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
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
		if(isset($this->request->post['menu_id']) || isset($this->request->post['status'])) {
			if(isset($this->request->post['menu_id'])) {
				$menu_id = $this->request->post['menu_id'];
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
				$this->load->model('menu/menu');
				$this->model_menu_menu->updateMenuStatus($menu_id, $convert);
				$json['success'] = true;
				$json['status'] = $convert;
			}
		}
		$this->response->setOutput(json_encode($json));
	}

	public function ajaxGetName() {
		$json = array();

		$this->load->model('menu/menu_type');
		$this->load->model('menu/menu_group');
		$this->load->model('menu/link_external');
		$this->load->model('menu/no_link');
		$this->load->model('news/category');
		$this->load->model('news/news');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');

		if(isset($this->request->get['menu_type_id'])) {
			$menu_type_id = $this->request->get['menu_type_id'];

			$menu_type_info = $this->model_menu_menu_type->getMenuType($menu_type_id);

			if($menu_type_info['route'] == 'cat_news') {
				$json = array(
					'data'  => $this->model_news_category->getCategories(0),
					'route' => 'category_id'
				);
			} elseif($menu_type_info['route'] == 'news') {
				$data = array(
					'filter_category_id' => 0
				);
				$json = array(
					'data'  => $this->model_news_news->getNewss($data),
					'route' => 'news_id'
				);
			} elseif($menu_type_info['route'] == 'cat_product') {
				$json = array(
					'data'  => $this->model_catalog_category->getCategories(0),
					'route' => 'category_id'
				);
			} elseif($menu_type_info['route'] == 'product') {
				$data = array(
					'filter_category_id' => 0
				);
				$json = array(
					'data'  => $this->model_catalog_product->getProducts($data),
					'route' => 'product_id'
				);
			} elseif($menu_type_info['route'] == 'internal') {
				$json = array(
					'data'  => $this->model_menu_menu_group->getLinkInternals(0),
					'route' => 'menu_group_id'
				);
			} elseif($menu_type_info['route'] == 'external') {
				$json = array(
					'data'  => $this->model_menu_link_external->getLinkExternals(0),
					'route' => 'link_external_id'
				);
			} elseif($menu_type_info['route'] == 'nolink') {
				$json = array(
					'data'  => $this->model_menu_no_link->getNoLinks(0),
					'route' => 'no_link_id'
				);
			} else {
				$json['error'] = true;
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}

?>