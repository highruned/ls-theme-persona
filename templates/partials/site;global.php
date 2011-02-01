<? $this->render_partial('site:functions') ?>

<?
$settings = $this->render_partial('site:settings');
  
$object = array(
  'settings' => $settings
);
?>

<? return $object ?>