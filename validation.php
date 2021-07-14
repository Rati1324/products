<?php
$valid = 1;
$messages = [];

function valid_sku($sku){
	if (strlen($sku) == 0 || strlen($sku) > 9){
		$valid = 0;
		return "Enter a 9 character SKU";
	}
	$valid = 1;
	return "";
}
function valid_name($name){
	if (empty($name)) {
		$valid = 0;
		return "This field can't be empty";
	}
	$valid = 1; 
	return "";
}
function valid_number($num){
	$msg = "";
	if (!is_numeric($num)) {
		$valid = 0;
		$msg = "Enter a valid number";
	}
	else if ((float)$num < 0){
		$valid = 0;
		$msg = "Enter a positive number";	
	} 
	else $valid = 1;
	return $msg;
}

$messages['sku'] = valid_sku($_POST['SKU']);
$messages['name'] = valid_name($_POST['name']);
$messages['price'] = valid_number($_POST['price']);

$start = 0;

foreach ($_POST as $k => $v){
	if ($start && !empty($v)){
		$messages[$k] = valid_number($v);
	}
	else if ($k == "type") $start = 1;
}