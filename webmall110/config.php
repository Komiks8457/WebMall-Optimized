<?php

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

$_config['site']    = [
    'title'         => 'LASTROGUE Online',
    'description'   => 'LASTROGUE Online',
    'keyword'       => 'LASTROGUE Online',
    'ssl'           => true,                            //using ssl
    'domain'        => 'webmall110.lastrogue.online',   //without https:// or http://
    'saltkey'       => 'E7n3PybeKPXLx7nKij4t',          //use to calculate sessionid
    'extension'     => '.html',                         //page extension
];

$_config['mssql']   = [
    'host'          => '192.168.0.110',                 //if custom port then IP:Port
    'userid'        => 'webmall',
    'passwd'        => '#Swastika369',
    'database'      => 'SILKROAD_R_ACCOUNT',
];

$_config['cache']   = [
    'enable'        => true,
    'max-age'       => 86400,
    'directory'     => 'cache'
];

$_config['server']  = ['ip' => '192.168.3.111'];
