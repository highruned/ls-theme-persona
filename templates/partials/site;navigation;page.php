<ul class="style-1 left">
  <li><a href="<?= root_url('/') ?>">Home</a></li>
  <?
    $list = array();
    $list[] = Cms_Page::create()->find_by_url('/contact');
    $list[] = Cms_Page::create()->find_by_url('/about');
    $list[] = Cms_Page::create()->find_by_url('/interests');
    $list[] = Cms_Page::create()->find_by_url('/work');
    $list[] = Cms_Page::create()->find_by_url('/resume');
    
    $this->render_partial('cms:pages', array(
      'list' => $list,
      'show_item_children' => false,
      'show_parent_list_wrapper' => false,
      'anchor_value' => "{title}",
      'child_list_class' => '',
      'anchor_attributes' => array()
    ));
  ?>
</ul><a class="left" href="<?= $site_settings->company->twitter_page ?>"><img src="<?= root_url('/') ?>resources/images/icon-tw.png" alt="Go to Twitter" /></a>