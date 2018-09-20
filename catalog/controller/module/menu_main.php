<?php
class ControllerModuleMenuMain extends Controller {
	public function index() {
		$this->load->model('menu/menu');

		$data['menus'] = array();

		$menu_group_id = $this->config->get('menu_main_menu_group');

		$results = $this->model_menu_menu->getMenus(0, $menu_group_id);

		$this->load->model('tool/image');

		$data['search'] = $this->load->controller('common/search');

		foreach ($results as $result) {
			$get_name = $this->model_menu_menu->getNameMenu($result['menu_id'], $result['menu_type_id'], $result['name_id']);
			$data['menus'][] = array(
				'menu_id'   => $result['menu_id'],
				'name'      => $get_name['name'],
				'children'  => $this->getPath($result['menu_id'], $menu_group_id),
				'href'      => $get_name['href'],
				'image'     => $this->model_tool_image->resize($result['image'], 70, 70, 'resize_and_crop'),
				'attribute' => $get_name['attribute']
			);
		}

		$data['cart'] = $this->load->controller('common/cart');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');

		return $this->load->view('module/menu_main', $data);
	}

	private function getPath($menu_id, $menu_group_id) {
		$this->load->model('menu/menu');

		$menus = array();

		$results = $this->model_menu_menu->getMenus($menu_id, $menu_group_id);

		foreach ($results as $result) {
			$get_name = $this->model_menu_menu->getNameMenu($result['menu_id'], $result['menu_type_id'], $result['name_id']);
			$menus[] = array(
				'menu_id'   => $result['menu_id'],
				'name'      => $get_name['name'],
				'children'  => $this->getPath($result['menu_id'], $menu_group_id),
				'href'      => $get_name['href'],
				'attribute' => $get_name['attribute']
			);
		}

		return $menus;
	}
}