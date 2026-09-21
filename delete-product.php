<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_product = $_GET['id'];
    $id_user = $_SESSION['user_id'];
    
    // YEU CAU: Click delete thi xoa product do di
    // TAI SAO CAN DIEU KIEN id_user = $id_user? De chong Hack/IDOR. Dam bao nguoi dung chi duoc phep xoa san pham cua chinh ho, khong the xoa cua nguoi khac du biet ID.
    $sql_delete = "DELETE FROM product WHERE id = '$id_product' AND id_user = '$id_user'";
    mysqli_query($con, $sql_delete);
}

header("Location: my-product.php");
exit();
?>
