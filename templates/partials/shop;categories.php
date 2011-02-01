<? 
  if(!isset($params['list']))
    $params['list'] = isset($parent) ? 
      $parent->list_children('front_end_sort_order') : 
      Shop_Category::create()->list_root_children('front_end_sort_order');
  
  $this->render_partial('core:list', array_merge(array(
    'url_variable_name' => 'url',
    'title_variable_name' => 'name',
    'sublist_function_name' => 'navigation_subpages',
    'anchor_title' => "View all products of {title}"
  ), $params));
?>

