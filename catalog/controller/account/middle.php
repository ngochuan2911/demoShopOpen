<?php
class ControllerAccountMiddle extends Controller {
	public function index() {
		$this->response->redirect($this->url->link('common/home', '', 'SSL'));
	}
}
