<?php
include("validation.php");
if ($valid){	
    include("product.php");
    unset($_POST['submit']);
    $_POST = array_filter($_POST);
    $class_name = Product::return_type($_POST['type'], $db);
    echo $class_name;
    $product = new $class_name(...$_POST, ...[$db]);
    $product->insert();
    header("location: index.php");
}