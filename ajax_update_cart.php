<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$action = $data['action'];

//tang
if($action == 'up'){
$_SESSION['CART'][$id]['qty'] = $_SESSION['CART'][$id]['qty'] + 1;
}
// giam
if ($action == 'down') {
    $_SESSION['CART'][$id]['qty'] = $_SESSION['CART'][$id]['qty'] - 1;
}
// xoa
if ($action == 'delete') {
    unset($_SESSION['CART'][$id]);
}

?>