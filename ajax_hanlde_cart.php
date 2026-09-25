<?php
session_start();
require_once 'connect.php';

// Nhan du lieu JSON theo javascript
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

if ($id) {
    // qua PHP goi ID ra, viet sql lay th0ng tin cua product nay theo ID (tra ve 1 mang)   => SS()
    $sql = "SELECT * FROM product WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    $product = mysqli_fetch_array($result);

    if ($product) {
        $mangcon = array(
            'id' => $product['id'],
            'title' => $product['title'],
            'price' => $product['price'],
            'img' => $product['image']
        );
        
        $mangcon['qty'] = 1;
        
        $_SESSION['CART'][] = $mangcon;

        echo json_encode(['status' => 'success', 'added' => $mangcon]);
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No ID received']);
}
?>
