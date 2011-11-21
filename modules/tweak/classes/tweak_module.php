<?

	class Tweak_Module extends Core_ModuleBase {
		private $cms_update_element;
		private $is_rendering_started;
		
		protected function get_info() {
			$info = new Core_ModuleInfo(
				"Tweak",
				"Provides assistance developing themes for your store.",
				"Limewheel Creative Inc."
			);
			
			$this->is_rendering_started = false;
			
			$helper = new Tweak_Helper();

			$cms_update_elements = post('cms_update_elements');
	
			if(!$cms_update_elements) // let's get out of here!
				return $info;
	
			foreach($cms_update_elements as $element => $partial) {
				if($partial == 'ls_cms_page') {
					unset($_POST['cms_update_elements'][$element]);
					
					if($element)
						$this->cms_update_element = $element;
				}
			}
		
			return $info;
		}
		
		public function subscribe_events() {
			Backend::$events->addEvent('cms:onBeforeHandleAjax', $this, 'before_handle_ajax');
			Backend::$events->addEvent('cms:onAfterHandleAjax', $this, 'after_handle_ajax');
			Backend::$events->addEvent('cms:onBeforeDisplay', $this, 'before_page_display');
		}
		
		public function before_page_display() {
			if($this->is_rendering_started) // have we started rendering? avoid looping
				return;
			
			$this->is_rendering_started = true; // we've started rendering
		
			// we want $site_settings for non-ajax
			$controller = Cms_Controller::get_instance();
			$controller->data['site_settings'] = $controller->render_partial('site:settings');
		}
	
		public function before_handle_ajax() {
			// we want $site_settings for ajax
			$controller = Cms_Controller::get_instance();
			$controller->data['site_settings'] = $controller->render_partial('site:settings');
		}
		
		public function after_handle_ajax() {
			if(!$this->cms_update_element)
				return;
				
			if($this->is_rendering_started) // have we started rendering? avoid looping
				return;
			
			$this->is_rendering_started = true; // we've started rendering
			
			$controller = Cms_Controller::get_instance();
			
			$params = array(); // does nothing
			$page = Cms_Page::findByUrl(Phpr::$request->getCurrentUri(), $params);
			
			ob_start();
			$params = array(); // does nothing
			$controller->open($controller->page, $params);
			ob_end_clean();
		
			echo ">>" . $this->cms_update_element . "<<";
			
			$controller->render_page();
		}
		
		/**
		 * Awaiting deprecation
		 */
		
		protected function createModuleInfo() {
			return $this->get_info();
		}
		
		public function subscribeEvents() {
			return $this->subscribe_events();
		}
	}
