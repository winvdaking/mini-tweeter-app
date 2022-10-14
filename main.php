<?php

require 'vendor/autoload.php';
$configfile = parse_ini_file('conf/config.ini');

use iutnc\tweeterapp\model\User;
use iutnc\tweeterapp\model\Follow;
use iutnc\tweeterapp\model\Tweet;

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

$users = User::select()->get();
$tweets = Tweet::select()->orderBy('updated_at')->get();
$tweetsPositifs = Tweet::where('score', '>', '0')->get();

$requete = User::select()->where('id', '=', 6);
$v = $requete->first(); 

echo($tweetsPositifs);

echo($v);

echo phpversion();