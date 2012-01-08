<?
function close_form() {
	echo '</form>';
}

function text_input($name, $label = null, $default = null,  $args = array()) {
	if(!isset($args['id'])) {
		$args['id'] = $name;
	}
	$return =  '<label for="'.$args['id'].'">'.$label.'</label> ';
	$return .= '<input type="text" name="'.$name.'" id="'.$args['id'].'" value="'.h(post($name, $default)).'" />';
	return $return;
}

function get($name, $default = null) {
	return Phpr::$request->getField($name, $default);
}
<?php

function close_form() {
	echo '</form>';
}

function text_input($name, $label = null, $default = null,  $args = array()) {
	if(!isset($args['id'])) {
		$args['id'] = $name;
	}
	$return =  '<label for="'.$args['id'].'">'.$label.'</label> ';
	$return .= '<input type="text" name="'.$name.'" id="'.$args['id'].'" value="'.h(post($name, $default)).'" />';
	return $return;
}

function get($name, $default = null) {
	return Phpr::$request->getField($name, $default);
}
<?php

function close_form() {
	echo '</form>';
}

function text_input($name, $label = null, $default = null,  $args = array()) {
	if(!isset($args['id'])) {
		$args['id'] = $name;
	}
	$return =  '<label for="'.$args['id'].'">'.$label.'</label> ';
	$return .= '<input type="text" name="'.$name.'" id="'.$args['id'].'" value="'.h(post($name, $default)).'" />';
	return $return;
}

function get($name, $default = null) {
	return Phpr::$request->getField($name, $default);
}
?>