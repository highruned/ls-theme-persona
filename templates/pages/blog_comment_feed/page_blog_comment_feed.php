<?= Blog_Post::get_comments_rss(
  $site_settings->company->title,
  "Comments",
  site_url('comments_rss'),
  site_url('blog/post'),
  site_url('blog/category'),
  site_url('blog'),
  20
) ?>