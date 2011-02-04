<?

if(!function_exists('site_settings')) {
  function site_settings() {
    return (object) array(
      'date' => date('F, j'),
      'charset' => 'utf-8',
      'company' => (object) array(
        'title' => Shop_CompanyInformation::get()->name,
        'slogan' => 'Slogan here',
        'sales_email' => 'name@site.com',
        'twitter_page' => 'http://twitter.com/',
        'facebook_page' => 'http://www.facebook.com/'
      ),
      'meta' => (object) array(
        'default_description' => "Meta description",
        'default_keywords' => "Meta keywords",
      ),
      'blog' => (object) array(
        'path' => '/blog/'
      )
    );
  }
}

return site_settings();