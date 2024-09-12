<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>LASTROGUE Online</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="Keywords" content="LASTROGUE Online" />
	<meta name="Description" content="LASTROGUE Online" />
	<link rel="stylesheet" href="assets/css/webmall_game.css" type="text/css" media="all" />
	<link rel="icon" href="assets/images/favicon.ico" type="image/ico" />
</head>
<body class="mig " ondragstart="return false;" onselectstart="return false;">
	<div id="wrap" class="error">
		<h1>Error</h1>
		<div id="screen">
			<div class="opener mold"></div>
			<div class="cropped">
				<p class="msg">An error has occurred. <?= (!is_null($_REQUEST['msg']) ? "(" . $_REQUEST['msg'] . ")" : null) ?><br>Please try again after closing Item Mall.</p>
			</div>
			<div class="closer mold"></div>
		</div>
	</div>
</body>
</html>