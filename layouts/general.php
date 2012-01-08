    <? $this->render_partial('site:head') ?>
  </head>
  <body>
    <nav id="navigation-social" class="box-2">
      <? $this->render_partial('site:navigation:social') ?>
    </nav>
    <nav id="navigation-page" class="">
      <? $this->render_partial('site:navigation:page') ?>
    </nav>
    <div id="content" class="pane">
      <ul>
      <?
      $url = Phpr::$request->getCurrentUri();

      $id = str_replace('/', '_', strtolower(substr($url, 1)));
        
      if(!$id)
        $id = 'home';
      ?>
        <li><section id="<?= $id ?>" class="active"><?= $this->render_page() ?></section></li>
      </ul>
    </div>
    <div id="loading" class="top"><span>Working...</span></div>
    <? $this->render_partial('site:foot') ?>
