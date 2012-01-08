<?
    if(!function_exists("array_merge_recursive_distinct")) {
    function array_merge_recursive_distinct () {
      $arrays = func_get_args();
      $base = array_shift($arrays);
      if(!is_array($base)) $base = empty($base) ? array() : array($base);
      foreach($arrays as $append) {
        if(!is_array($append)) $append = array($append);
        foreach($append as $key => $value) {
          if(!array_key_exists($key, $base) and !is_numeric($key)) {
            $base[$key] = $append[$key];
            continue;
          }
          if(is_array($value) || (isset($base[$key]) && is_array($base[$key]))) {
            $base[$key] = array_merge_recursive_distinct($base[$key], $append[$key]);
          } else if(is_numeric($key)) {
            if(!in_array($value, $base)) $base[] = $value;
          } else {
            $base[$key] = $value;
          }
        }
      }
      return $base;
    }
  }
  
  extract(array_merge_recursive_distinct(array(
    'list' => array(),
    'return_output' => false,
    'use_anchor_classes' => false,
    'anchor_default_class' => '',
    'anchor_current_class' => 'current',
    'anchor_first_class' => 'first',
    'anchor_last_class' => 'last',
    'use_item_classes' => true,
    'item_default_class' => '',
    'item_current_class' => 'current',
    'item_first_class' => 'first',
    'item_last_class' => 'last',
    'show_item_children' => false,
    'item_delimiter' => '|',
    'show_item_delimiter' => false,
    'use_list_classes' => true,
    'current_item_url' => null,
    'parent' => null,
    'parent_list_class' => '',
    'parent_list_id' => '',
    'child_list_class' => '',
    'before_parent_items' => null,
    'after_parent_items' => null,
    'before_children_items' => null,
    'after_children_items' => null,
    'render_before' => null,
    'render_after' => null,
    'show_parent_list_wrapper' => true,
    'show_children_list_wrapper' => true,
    'before_item' => null,
    'after_item' => null,
    'show_anchor' => true,
    'before_anchor' => null,
    'after_anchor' => null,
    'anchor_value' => "{title}",
    'anchor_attributes' => array(
      'title' => "View {title}",
      'href' => "{url}",
    ),
    'item_attributes' => array(
     ),
    'partial_name' => 'core:list',
    'url_variable_name' => '',
    'url_function_name' => '',
    'title_function_name' => '',
    'title_variable_name' => '',
    'sublist_function_name' => ''
  ), $params));

if($list instanceof Db_DataCollection)
    $list = $list->as_array();
?>

<? if($return_output) ob_start() ?>
<? if(count($list)): ?>

<? if((!$parent && $show_parent_list_wrapper) || ($parent && $show_children_list_wrapper)): ?>
<ul id="<?= !$parent ? $parent_list_id : null ?>" class="<? if($use_list_classes): ?><?= !$parent ? $parent_list_class : null ?> <?= $parent ? $child_list_class : null ?><? endif ?>">
<? endif ?>
  <?= $parent ? null : $before_parent_items ?>
  <?= $parent ? $before_children_items : null ?>
  <? if($render_before) $this->render_partial($render_before[0], $render_before[1]) ?>
  
  <? foreach($list as $i => $item): ?>
  <?
    $is_first = ($i == 0);
    $is_last = ($i == count($list) - 1);
    $is_current = ($item->url == $current_item_url);
    $title = $title_variable_name ? $item->$title_variable_name : $item->$title_function_name();
    $url = $url_variable_name ? $item->$url_variable_name : $item->$url_function_name();
  ?>

  <?= $before_item ?><li class="<? if($use_item_classes): ?><?= $item_default_class ?> <?= $is_current ? $item_current_class : null ?> <?= $is_first ? $item_first_class : null ?> <?= $is_last ? $item_last_class : null ?><? endif ?>" <? foreach($item_attributes as $key => $value) echo $key . '="' . str_replace(array('{title}', '{url}'), array(h($item->$title_function_name()), $item->$url_variable_name), $value) . '" '; ?> >
  <?= $before_anchor ?><? if($show_anchor): ?><a <? foreach($anchor_attributes as $key => $value) echo $key . '="' . str_replace(array('{title}', '{url}'), array(h($item->$title_function_name()), $item->$url_variable_name), $value) . '" '; ?> class="<? if($use_anchor_classes): ?><?= $anchor_default_class ?> <?= $is_current ? $item_current_class : null ?> <?= $is_first ? $item_first_class : null ?> <?= $is_last ? $item_last_class : null ?><? endif ?>"><?= str_replace(array('{title}', '{url}'), array(h($title), $url), $anchor_value) ?></a><? endif ?><?= $after_anchor ?> <?= $show_item_delimiter && !$is_last ? $item_delimiter : null ?>
    <? if($child_list = $item->$sublist_function_name()): ?>
      <? unset($params['render_before'], $params['render_after']) ?>
      <? if($show_item_children) $this->render_partial($partial_name, array_merge($params, array('list' => $child_list, 'parent' => $item))) ?>
    <? endif ?>
  </li><?= $after_item ?>
  <? endforeach ?>
  
  <?= $parent ? null : $after_parent_items ?>
  <?= $parent ? $after_children_items : null ?>
  <? if($render_after) $this->render_partial($render_after[0], $render_after[1]) ?>
<? if((!$parent && $show_parent_list_wrapper) || ($parent && $show_children_list_wrapper)): ?>
</ul>
<? endif ?>
<? endif ?>
<? if($return_output) { $content = ob_get_contents(); ob_end_clean(); return $content; } ?>