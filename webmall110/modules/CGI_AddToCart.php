<?php
$_pid = $_POST['cart'] ?? false;

$_json = ['response'=>-999];

if ($_pid === FALSE || !$fn->ResumeSession()) {
    $_json['response'] = -998;
    $_json['message']  = 'getlost';
} else {
    $_json['response'] = $fn->AddToCart($_pid);
}

header('Content-Type: application/json');
echo json_encode($_json);
?>