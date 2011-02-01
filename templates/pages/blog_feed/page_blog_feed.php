<?= Blog_Post::get_rss(
  $site_settings->company->title,
  $site_settings->company->title . " news and updates",
  site_url('blog/feed'),
  site_url('blog/post'),
  site_url('blog/category'),
  site_url('blog'),
  20
) ?>