<div class="content-header">
  <h1>Persona</h1>
  <h2>a LemonStand Theme</h2>
</div>
<div class="content-body-wrapper box-1">
  <div class="content-body">
  <? foreach(Blog_Post::create()->order('blog_posts.published_date desc')->where('is_published=1')->find_all() as $i => $post): ?>
  <?
  $title = $post->url_title;
  $description = $post->description;
  $url = root_url('/') . 'blog/post/' . $post->url_title . "/";
  $comment_count = $post->approved_comment_num;
  ?>
    <div class="blog-post style-1 left">
      <h3><a href="<?= $url ?>"><?= h($post->title) ?></a></h3>
      <p class="header"><small><?= $post->published_date->format('%F') ?></small> <a href="<?= $url ?>#comments">(<? if($comment_count):?><?= $comment_count ?> Comment<? if($comment_count > 1): ?>s<? endif ?><? else: ?>No comments<? endif ?>)</a></p>
      <p class="content"><?= $description ?></p>
      <p class="footer"><a href="<?= $url ?>">Read more &raquo;</a> <a href="<?= $url ?>">Leave a comment &raquo;</a></p>
    </div>
    <? if($i % 2 == 1): ?><br clear="both" /><? endif ?>
  <? endforeach ?>
  </div>
</div>