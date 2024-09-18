<?php
$_value = $_GET['value'] ?? null;

if (is_null($_value) || $fn->UserIPv4() !== SERVER_IP) {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit();
}
