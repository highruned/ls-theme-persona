<? 
$this->render_partial('core:list', array_merge(array(
  'url_variable_name' => 'url',
  'title_function_name' => 'navigation_label',
  'sublist_function_name' => 'navigation_subpages',
  'current_item_url' => $this->page->url
), $params));
?>

