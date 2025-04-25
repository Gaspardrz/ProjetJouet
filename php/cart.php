<?php
include __DIR__ . '/php/includes/footer.php';

session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

switch($data['action'] ?? '') {
  case 'add':
    $id = (int)$data['product_id'];
    $qty = (int)($data['quantity'] ?? 1);
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
    echo json_encode(['status'=>'success']);
    break;
  case 'remove':
    $id = (int)$data['product_id'];
    unset($_SESSION['cart'][$id]);
    echo json_encode(['status'=>'success']);
    break;
  default:
    echo json_encode(['status'=>'error','message'=>'Action inconnue']);
}
