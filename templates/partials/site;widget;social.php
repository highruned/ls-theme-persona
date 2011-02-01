<ul class="style-2">
  <li class="first"><a href="javascript:;">&nbsp;</a></li>
  <? foreach($list as $item): ?>
  <li>
    <a href="<?= $item[2] ?>" title="Go to <?= $item[1] ?>" target="_blank">
      <span class="icon <?= $item[0] ?>">&nbsp;</span>
      <span class="title"><?= $item[1] ?></span>
    </a>
  </li>
  <? endforeach ?>
  <li class="last"><a href="javascript:;">&nbsp;</a></li>
</ul>