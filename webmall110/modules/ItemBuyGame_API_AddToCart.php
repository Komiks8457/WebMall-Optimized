<?php
header('Content-Type: application/json');

$_json = ['response'=>-999];

$_pid = $_POST['cart'] ?? false;

//$fn->WriteLog($_pid);

if ($_pid === FALSE || !$fn->ResumeSession()) {
    $_json['response'] = -998;
    $_json['message'] = 'getlost';
}
else
    $_json['response'] = $fn->AddToCart($_pid);

echo json_encode($_json);
?>