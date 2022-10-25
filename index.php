<?php

use iutnc\mf\view\AbstractView;

require 'vendor/autoload.php';
$configfile = parse_ini_file('conf/config.ini');

AbstractView::setAppTitle('TweeterApp by dodo');
AbstractView::addStyleSheet('style/style.css');

try {
    $db = new \Illuminate\Database\Capsule\Manager();

    $db->addConnection($configfile);
    $db->setAsGlobal();
    $db->bootEloquent();

    $router = new \iutnc\mf\router\Router();

    $router->addRoute('home', 'list_tweets',      '\iutnc\tweeterapp\control\HomeController');
    $router->addRoute('view', 'view_tweet',       '\iutnc\tweeterapp\control\TweetController');
    $router->addRoute('user', 'view_user_tweets', '\iutnc\tweeterapp\control\UserController');

    $router->setDefaultRoute('list_tweets');

    //print_r($router->routes());

    $router->run();
} catch (\PDOException $th) {
    die($th->getMessage());
}