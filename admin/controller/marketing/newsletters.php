<?php

class ControllerMarketingNewsletters extends Controller
{
	private $error = array();

	public function index()
	{
		$this->language->load('marketing/newsletters');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/newsletters');

		$this->getList();
	}

	public function view()
	{
		$this->language->load('marketing/newsletters');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/newsletters');

		$this->getView();
	}

	public function delete()
	{


		$this->language->load('marketing/newsletters');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/newsletters');

		if(isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $newsletters_id) {
				$this->model_marketing_newsletters->deleteNewsletters($newsletters_id);
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

			$this->response->redirect($this->url->link('marketing/newsletters', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList()
	{
		if(isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'date_added';
		}

		if(isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('marketing/newsletters', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$newsletters_total = $this->model_marketing_newsletters->getTotalNewsletterss();

		$data['newsletterss'] = array();

		$results = $this->model_marketing_newsletters->getNewsletterss($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('marketing/newsletters/view', 'token=' . $this->session->data['token'] . '&newsletters_id=' . $result['newsletters_id'] . $url, 'SSL')
			);
			$data['newsletterss'][] = array(
				'newsletters_id' => $result['newsletters_id'],
				'name'       => $result['name'],
				'email'      => $result['email'],
				'date_added' => date("H:i d-m-Y", strtotime($result['date_added'])),
				'selected'   => isset($this->request->post['selected']) && in_array($result['newsletters_id'], $this->request->post['selected']),
				'action'     => $action
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_list'] = $this->language->get('text_list');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_email'] = $this->language->get('column_email');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_content'] = $this->language->get('column_content');
		$data['column_action'] = $this->language->get('column_action');

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

		$url = '';

		if($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('marketing/newsletters', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_email'] = $this->url->link('marketing/newsletters', 'token=' . $this->session->data['token'] . '&sort=email' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('marketing/newsletters', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, 'SSL');

		$url = '';

		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if(isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $newsletters_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/newsletters', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($newsletters_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($newsletters_total - $this->config->get('config_limit_admin'))) ? $newsletters_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $newsletters_total, ceil($newsletters_total / $this->config->get('config_limit_admin')));

		$data['deletel'] = $this->url->link('marketing/newsletters/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('marketing/newsletters_list', $data));
	}

	protected function validateDelete()
	{
		if(!$this->user->hasPermission('modify', 'marketing/newsletters')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}

?>