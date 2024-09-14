<?php

//SITE INFO
define('TITLE',         $_config['site']['title']);
define('DESC',          $_config['site']['description']);
define('KEYWORD',       $_config['site']['keyword']);
define('SSL',           $_config['site']['ssl']);
define('DOMAIN',        $_config['site']['domain']);
define('SALTKEY',       $_config['site']['saltkey']);
define('EXT',           $_config['site']['extension']);

//MSSQL INFO
define('SQL_DB_HOST',   $_config['mssql']['host']);
define('SQL_DB_USERID', $_config['mssql']['userid']);
define('SQL_DB_PASSWD', $_config['mssql']['passwd']);
define('SQL_DB_NAME',   $_config['mssql']['database']);

//Others
define('ITEMBUYGAME',   "/ItemBuyGame" . EXT);

//Cache
define('CACHE_ENABLE',  $_config['cache']['enable']);
define('CACHE_MAX_AGE', $_config['cache']['max-age']);
define('CACHE_DIR',     ABSPATH . $_config['cache']['directory'] . "/");

//Server
define('SERVER_IP',     $_config['server']['ip']);