<?php

class ControllerMenuMenu extends Controller
{
	private $error = array();

	public function index()
	{
		$this->language->load('menu/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu');

		$this->getList();
	}

	public function insert()
	{
		$this->language->load('menu/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu');
		$this->load->model('menu/menu_type');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_menu->addMenu($this->request->post, $this->request->get['menu_group_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu', 'token=' . $this->session->data['token'] . $url, 'SSL').'&menu_group_id='.$this->request->get['menu_group_id']);
		}
		$this->getForm();
	}

	public function update()
	{
		$this->language->load('menu/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu');
		$this->load->model('menu/menu_type');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_menu_menu->editMenu($this->request->get['menu_id'], $this->request->post, $this->request->get['menu_group_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu', 'token=' . $this->session->data['token'] . $url, 'SSL').'&menu_group_id='.$this->request->get['menu_group_id']);
		}

		$this->getForm();
	}

	public function delete()
	{
		$this->language->load('menu/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('menu/menu');

		if(isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $menu_id) {
				$this->model_menu_menu->deleteMenu($menu_id, $this->request->get['menu_group_id']);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if(isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('menu/menu', 'token=' . $this->session->data['token'] . $url, 'SSL').'&menu_group_id='.$this->request->get['menu_group_id']);
		}

		$this->getList();
	}

	protected function getList()
	{
		$this->load->model('menu/menu_group');
		$menu_info_title = $this->model_menu_menu_group->getMenuGroupDescriptions($this->request->get['menu_group_id']);

		$data['heading_title'] = $menu_info_title[$this->config->get('config_language_id')]['name'];

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('menu/menu', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' / '
		);

		$data['add'] = $this->url->link('menu/menu/insert', 'token=' . $this->session->data['token'], 'SSL').'&menu_group_id='.$this->request->get['menu_group_id'];
		$data['delete'] = $this->url->link('menu/menu/delete', 'token=' . $this->session->data['token'], 'SSL').'&menu_group_id='.$this->request->get['menu_group_id'];
		$data['cancel'] = $this->url->link('menu/menu_group', 'token=' . $this->session->data['token'], 'SSL').'&menu_group_id='.$this->request->get['menu_group_id'];

		$data['menus'] = array();

		$results = $this->model_menu_menu->getMenus(0, $this->request->get['menu_group_id']);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('menu/menu/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $result['menu_id']. '&menu_group_id=' . $this->request->get['menu_group_id'], 'SSL')
			);

			$data['menus'][] = array(
				'menu_id'      => $result['menu_id'],
				'name_id'      => $result['name_id'],
				'menu_type'    => $result['menu_type'],
				'column'       => $result['column'],
				'sort_order'   => $result['sort_order'],
				'status'       => $result['status'],
				'status_image' => ($result['status'] ? 'view/image/enabled.png' : 'view/image/disabled.png'),
				'selected'     => isset($this->request->post['selected']) && in_array($result['menu_id'], $this->request->post['selected']),
				'action'       => $action
			);
		}

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_menu_type'] = $this->language->get('column_menu_type');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_column'] = $this->language->get('column_column');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_menu_type'] = $this->language->get('column_menu_type');

		$data['text_tooltip_enabled'] = $this->language->get('text_tooltip_enabled');
		$data['text_tooltip_disabled'] = $this->language->get('text_tooltip_disabled');

		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_cancel'] = $this->language->get('button_cancel');

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

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('menu/menu_list', $data));
	}

	protected function getForm()
	{
		$this->load->model('menu/menu_group');
		$menu_info_title = $this->model_menu_menu_group->getMenuGroupDescriptions($this->request->get['menu_group_id']);

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['heading_title'] = $menu_info_title[$this->config->get('config_language_id')]['name'];

		$data['text_none'] = $this->language->get('text_none');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_form'] = $this->language->get('text_form');

		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_image_manager'] = $this->language->get('text_image_manager');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_menu_type'] = $this->language->get('entry_menu_type');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_title_description'] = $this->language->get('entry_title_description');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_description'] = $this->language->get('entry_description');

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

		if(isset($this->error['menu_type_id'])) {
			$data['error_menu_type_id'] = $this->error['menu_type_id'];
		} else {
			$data['error_menu_type_id'] = '';
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
			'href'      => $this->url->link('menu/menu', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if(!isset($this->request->get['menu_id'])) {
			$data['action'] = $this->url->link('menu/menu/insert', 'token=' . $this->session->data['token'] . $url, 'SSL').'&menu_group_id='.$this->request->get['menu_group_id'];
		} else {
			$data['action'] = $this->url->link('menu/menu/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $this->request->get['menu_id'] . $url, 'SSL').'&menu_group_id='.$this->request->get['menu_group_id'];
		}

		$data['cancel'] = $this->url->link('menu/menu', 'token=' . $this->session->data['token'] . $url, 'SSL').'&menu_group_id='.$this->request->get['menu_group_id'];

		if(isset($this->request->get['menu_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$menu_info = $this->model_menu_menu->getMenu($this->request->get['menu_id']);
			$data['name_id'] = $menu_info['name_id'];
		}

		$data['menu_types'] = $this->model_menu_menu_type->getMenuTypes(0, true);

		$menus = $this->model_menu_menu->getMenus(0, $this->request->get['menu_group_id']);

		// Remove own id from list
		if(!empty($menu_info)) {
			foreach ($menus as $key => $menu) {
				if($menu['menu_id'] == $menu_info['menu_id']) {
					unset($menus[$key]);
				}
			}
		}

		$data['menus'] = $menus;

		if(isset($this->request->post['name_id'])) {
			$data['name_id'] = $this->request->post['name_id'];
		} elseif(!empty($menu_info)) {
			$data['name_id'] = $menu_info['name_id'];
		} else {
			$data['name_id'] = '';
		}

		if(isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif(!empty($menu_info)) {
			$data['description'] = $this->model_menu_menu->getMenuDescription($this->request->get['menu_id']);;
		} else {
			$data['description'] = array();
		}

		if(isset($this->request->post['menu_type_id'])) {
			$data['menu_type_id'] = $this->request->post['menu_type_id'];
		} elseif(!empty($menu_info)) {
			$data['menu_type_id'] = $menu_info['menu_type_id'];
		} else {
			$data['menu_type_id'] = '';
		}

		if(isset($this->request->post['parent_id'])) {
			$data['parent_id'] = $this->request->post['parent_id'];
		} elseif(!empty($menu_info)) {
			$data['parent_id'] = $menu_info['parent_id'];
		} else {
			$data['parent_id'] = 0;
		}

		if(isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif(!empty($menu_info)) {
			$data['image'] = $menu_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if(isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif(!empty($menu_info) && $menu_info['image'] && file_exists(DIR_IMAGE . $menu_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($menu_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['no_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if(isset($this->request->post['column'])) {
			$data['column'] = $this->request->post['column'];
		} elseif(!empty($menu_info)) {
			$data['column'] = $menu_info['column'];
		} else {
			$data['column'] = 1;
		}

		if(isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif(!empty($menu_info)) {
			$data['sort_order'] = $menu_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if(isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif(!empty($menu_info)) {
			$data['status'] = $menu_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('menu/menu_form', $data));
	}

	protected function validateForm()
	{
		if(!$this->user->hasPermission('modify', 'menu/menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if($this->request->post['menu_type_id'] == 0) {
			$this->error['menu_type_id'] = $this->language->get('error_menu_type_id');
		}

		if($this->request->post['name_id'] == 0) {
			$this->error['name_id'] = $this->language->get('error_name_id');
		}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete()
	{
		if(!$this->user->hasPermission('modify', 'menu/menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function ajaxed()
	{
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

	public function ajaxGetName()
	{
		$json = array();

		$this->load->model('menu/menu_type');
		$this->load->model('menu/link_internal');
		$this->load->model('menu/link_external');
		$this->load->model('news/category');
		$this->load->model('news/news');
		$this->load->model('news/information');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('catalog/manufacturer');

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
					'data'  => $this->model_menu_link_internal->getLinkInternals(0),
					'route' => 'link_internal_id'
				);
			} elseif($menu_type_info['route'] == 'external') {
				$json = array(
					'data'  => $this->model_menu_link_external->getLinkExternals(0),
					'route' => 'link_external_id'
				);
			} elseif($menu_type_info['route'] == 'information') {
				$json = array(
					'data'  => $this->model_news_information->getInformations(array()),
					'route' => 'information_id'
				);
			} elseif($menu_type_info['route'] == 'manufacturer') {
				$json = array(
					'data'  => $this->model_catalog_manufacturer->getManufacturers(array()),
					'route' => 'manufacturer_id'
				);
			} else {
				$json['error'] = true;
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}

?>