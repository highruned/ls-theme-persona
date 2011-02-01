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
    <a href="https://github.com/ericmuyser/ls-theme-persona"><img style="position: absolute; top: 0; left: 0; z-index: 99999; border: 0;" src="https://assets1.github.com/img/c641758e06304bc53ae7f633269018169e7e5851?repo=&url=http%3A%2F%2Fs3.amazonaws.com%2Fgithub%2Fribbons%2Fforkme_left_white_ffffff.png&path=" alt="Fork me on GitHub"></a>
    <? $this->render_partial('site:foot') ?>
