<?

if(!function_exists('site_settings')) {
  function site_settings() {
    return (object) array(
      'date' => date('F, j'),
      'charset' => 'utf-8',
      'company' => (object) array(
        'title' => Shop_CompanyInformation::get()->name,
        'slogan' => 'Metacoder',
        'sales_email' => 'eric.muyser@gmail.com',
        'twitter_page' => 'http://twitter.com/ericmuyser',
        'facebook_page' => 'http://www.facebook.com/ericmuyser'
      ),
      'customer' => (object) array(
        'default_email' => 'email@yourdomain.com',
      ),
      'meta' => (object) array(
        'default_description' => "Code is Poetry",
        'default_keywords' => "eric muyser, coder, programmer, programming, jquery, php, api, scripts, youtube, lemonstand, wordpress, themes, classes, open source",
      ),
      'category' => (object) array(
        'products_per_page' => 15
      ),
      'search' => (object) array(
        'products_per_page' => 6
      ),
      'blog' => (object) array(
      'path' => '/blog/'
      )
    );
  }
}

return site_settings();