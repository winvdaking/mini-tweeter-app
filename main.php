<?php

require 'vendor/autoload.php';
$configfile = parse_ini_file('conf/config.ini');

use iutnc\tweeterapp\model\User;
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

try {
    $db = new \Illuminate\Database\Capsule\Manager();

    $db->addConnection($config);
    $db->setAsGlobal();
    $db->bootEloquent();

    $users = User::select()->get();
    $tweets = Tweet::select()->orderBy('updated_at')->get();
    $tweetsPositifs = Tweet::where('score', '>', '0')->get();

    $requete = User::select()->where('id', '=', 6);
    $v = $requete->first();

    $vt = Tweet::where('id', '=', 55)->first();
    var_dump($vt);
    $result = $vt->author()->get();
    var_dump($result);
    echo ($result);

    echo phpversion();
} catch (\Throwable $th) {
    die($th->getMessage());
}
