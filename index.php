<?php
session_start();

require 'vendor/autoload.php';

use iutnc\mf\view\AbstractView;

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
    $router->addRoute('view', 'view_tweet',       '\iutnc\tweeterapp\control\TweetController', \iutnc\tweeterapp\auth\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('user', 'view_user_tweets', '\iutnc\tweeterapp\control\UserController', \iutnc\tweeterapp\auth\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('view_tweet', 'view_tweet', '\iutnc\tweeterapp\control\TweetController', \iutnc\tweeterapp\auth\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('post', 'post_tweet', '\iutnc\tweeterapp\control\PostController', \iutnc\tweeterapp\auth\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('signup','signup', '\iutnc\tweeterapp\control\SignUpController');
    $router->addRoute('login','login','\iutnc\tweeterapp\control\LoginController');
    $router->addRoute('logout','logout','\iutnc\tweeterapp\control\LogoutController', \iutnc\tweeterapp\auth\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('following','view_following','\iutnc\tweeterapp\control\FollowingController', \iutnc\tweeterapp\auth\TweeterAuthentification::ACCESS_LEVEL_USER);

    $router->setDefaultRoute('list_tweets');

    $router->run();
} catch (\PDOException $th) {
    die($th->getMessage());
}