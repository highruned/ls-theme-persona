<?

class Tweak_Module extends Core_ModuleBase {
  public $cms_update_element;
  
  protected function createModuleInfo()
  {
    $info = new Core_ModuleInfo(
      "Tweak",
      "Developer tool for global site settings management",
      "Eric Muyser"
    );
    
    $helper = new Tweak_Helper();
    //$helper->on_handleRequest();

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
  
  public function subscribeEvents() {
    Backend::$events->addEvent('cms:onBeforeHandleAjax', $this, 'before_handle_ajax');
    Backend::$events->addEvent('cms:onAfterHandleAjax', $this, 'after_handle_ajax');
    Backend::$events->addEvent('cms:onBeforeDisplay', $this, 'before_page_display');
  }
  
  public function before_page_display() {
		// we want $site_settings for non-AJAX
    $controller = Cms_Controller::get_instance();
    $controller->data['site_settings'] = $controller->render_partial('site:settings');
  }

  public function before_handle_ajax() {
		// we want $site_settings for AJAX
    $controller = Cms_Controller::get_instance();
    $controller->data['site_settings'] = $controller->render_partial('site:settings');
  }
	
	public function after_handle_ajax() {
    if(!$this->cms_update_element)
      return;
    
		$controller = Cms_Controller::get_instance();
    $controller->action();
    
    $params = array(); // does nothing
    $page = Cms_Page::findByUrl(Phpr::$request->getCurrentUri(), $params);
    
    ob_start();
    $controller->open($page, $params);
    ob_end_clean();
  
    echo ">>" . $this->cms_update_element . "<<";
    
    $controller->render_page();
	}
}
