<?php

require 'vendor/autoload.php';
$configfile = parse_ini_file('conf/config.ini');

use iutnc\tweeterapp\model\User;
use iutnc\tweeterapp\model\Follow;

$config = [ /* ces informations doivent être dans un fichier ini */
    'driver'    => 'mysql',
    'host'      => $configfile['host'],
    'database'  => $configfile['database'],
    'username'  => $configfile['user'],
    'password'  => $configfile['pass'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
];

$db = new \Illuminate\Database\Capsule\Manager();

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

$f = User::select()->get();

echo($f);

echo phpversion();