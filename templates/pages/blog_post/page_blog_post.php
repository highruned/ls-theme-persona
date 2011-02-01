<div class="content-header">
  <h1><?= $post->title ?></h1>
  <h2></h2>
</div>
<div class="content-body-wrapper box-1">
  <div class="content-body blog-post">
    <?= $post->content ?>
    <br /><br />
    <br /><br />
    <h3>Comments (<?= $post->approved_comment_num ?>)</h3>
    <br />
  <? if(!$post->approved_comment_num): ?>
    <p>No comments posted yet. Be the first!</p>
  <? else: ?>
    <ul>
    <? 
    foreach($post->approved_comments as $comment):
      $site_url_specified = strlen($comment->author_url);
    ?>
      <li>
        <p>
          <? if($site_url_specified): ?><a href="<?= $comment->getUrlFormatted() ?>" target="_blank"><? endif ?>
          <?= h($comment->author_name) ?>
          <? if($site_url_specified): ?></a><? endif ?>
          <br />
          <?= $comment->created_at->format('%F') ?>
        </p>
        <br />
        <p><?= nl2br(h($comment->content)) ?></p>
        <br /><br />
      </li>
    <? endforeach ?>
    </ul>
  <? endif ?>
  <? if($post->comments_allowed): ?>
    <br /><br />
    <h3>Post a Comment</h3>
    <br />
    <div id="comment-form">
      <? $this->render_partial('site:blog:comment_form') ?>
    </div>
  <? endif ?>
  </div>
</div>