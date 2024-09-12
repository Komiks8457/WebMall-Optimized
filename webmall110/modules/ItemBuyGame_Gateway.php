<?php

$_url = null;
$_jid = $_GET['jid'] ?? null;
$_key = $_GET['key'] ?? null;
$_loc = $_GET['loc'] ?? null;
$_pid = $_GET['pid'] ?? null;

if (is_null($_jid) || is_null($_key)) {
    header("Location: " . $fn->BuildErrorUrl(1));
    exit();
}

if (!$fn->Initialize($_jid, $_key, $_loc)) {
    header("Location: " . $fn->BuildErrorUrl(2));
    exit();
}

if (!isset($_COOKIE['ext']) || $_COOKIE['ext'] != EXT)
    setcookie("ext", EXT, ['samesite'=>'strict']);

if (!isset($_COOKIE['loc']) || $_COOKIE['loc'] != $_loc)
    setcookie("loc", $_loc, ['samesite'=>'strict']);

$_url = (SSL ? "https://" : "http://") . DOMAIN . ITEMBUYGAME . (!is_null($_pid) ? "&pid=" . $_pid : null);

?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>LASTROGUE Online</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Keywords" content="LASTROGUE Online" />
    <meta name="Description" content="LASTROGUE Online" />
    <style>
        html, body, div, span, applet, object,
        iframe, h1, h2, h3, h4, h5, h6, p,
        blockquote, pre, a, abbr, acronym,
        address, big, cite, code, del, dfn,
        em, font, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt,
        var, dl, dt, dd, ol, ul, li, fieldset,
        form, label, legend, table, caption,
        tbody, tfoot, thead, tr, th, td
        {
            margin: 0;
            padding: 0;
            vertical-align: baseline;
            overflow: hidden;
            border: none;
        }
        .container {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 800px;
            height: 569px;
            background-color: #201D19;
        }
        .iframe {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: #201D19;
        }
    </style>
</head>
<body class="body" onselectstart="return false" ondragstart="return false">
    <div class="container">
        <iframe class="iframe" src="<?= $_url ?>" scrolling="no" allowtransparency="true" allowpaymentrequest="true"></iframe>
    </div>
</body>
</html>