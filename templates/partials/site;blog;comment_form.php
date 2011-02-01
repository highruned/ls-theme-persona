<? if(!isset($comment_success) || !$comment_success): ?>
  <?= open_form() ?>
    <ul class="form">
      <li class="field text left">
        <label for="author_name">Name</label>           
        <div class="text-box">
          <input id="author_name" type="text" name="author_name" />
        </div>
      </li>
      <li class="field text left clearfix">
        <label for="author_email">Email</label>
        <div class="text-box">
          <input id="author_email" type="text" name="author_email" />
        </div>
      </li>  
      <li class="field text left clearfix">
        <label for="author_url">Website</label>
        <div class="text-box">
          <input id="author_url" type="text" name="author_url" />
        </div>
      </li>  
      <li class="field text clearfix">
        <label for="comment_content">Comment</label>
        <div class="text-area">
          <textarea id="comment_content" name="content" rows="6"></textarea>
        </div>
      </li>
      <li class="field clearfix">
        <label class="left" for="subscribe_to_notifications">Notify me if someone else comments on this post &nbsp;</label>
        <input id="subscribe_to_notifications" class="left" type="checkbox" name="subscribe_to_notifications" value="1" />
      </li>
      <li class="field text clearfix">
        <input type="hidden" name="cms_handler_name" value="blog:on_postComment" />
        <input type="hidden" name="cms_update_elements[comment-form]" value="site:blog:comment_form" />
        <div class="submit-box">
          <input type="submit" value="SUBMIT" onclick="return $(this).getForm().sendRequest('blog:on_postComment')" />
        </div>
      </li>
    </ul>
  <?= close_form() ?>
<? else: ?>
  <p>Your comment has been posted, and is awaiting approval. Thank you!</p>
<? endif ?>