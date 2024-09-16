<?php
$_ping = $_POST['ping'] ?? false;

$_json = ['pong'=>-999, 'message'=>null];

if ($_pid === FALSE || !$fn->ResumeSession()) {
    $_json['pong'] = -998;
    $_json['error'] = 8;
} else {
    $_json['pong'] = -1;
    $_json['error'] = 9;
}

header('Content-Type: application/json');
echo json_encode($_json, JSON_UNESCAPED_SLASHES);