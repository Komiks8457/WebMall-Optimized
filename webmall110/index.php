<?php
ob_start();

include "config.php";
require "libs/Common.php";
$fn = new Common();

$_req = $_GET['req'] ?? null;

if (is_null($_req)) {
    header("Location: " . $fn->BuildErrorUrl());
    exit();
}

switch ($_req) {
    case stristr($_req, "addtocart"):
        require('modules/CGI_AddToCart.php');
        break;
    case stristr($_req, "billing"):
        require('modules/CGI_Billing.php');
        break;
    case stristr($_req, "heartbeat"):
        require('modules/CGI_Heartbeat.php');
        break;
    case stristr($_req, "gateway"):
        require('modules/ItemBuyGame_Gateway.php');
        break;
    case stristr($_req, "error"):
        require('modules/ItemBuyGame_Error.php');
        break;
    case stristr($_req, "itembuygame"):
        require('modules/ItemBuyGame.php');
        break;
    default:
        header("Location: " . $fn->BuildErrorUrl());
        exit();
}

ob_end_flush();
