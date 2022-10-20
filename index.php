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

    $router->urlFor('user', [['id',  12], ['user', 'john']]);

    /*
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        switch ($_GET['action']) {
            case 'all_tweets':
                $ctrl = new iutnc\tweeterapp\control\HomeController();
                $ctrl->execute();
                break;

            case 'all_users':
                $sqlUsers = 'SELECT fullname, username FROM user';
                $users = $db->query($sqlUsers);

                $html = "Users :<br>";
                while ($ligne = $users->fetch()) {
                    $html .= $ligne['fullname'] . " - " . $ligne['username'] . "<br>";
                }
                break;

            case 'add_user':
                $html = '
                <form action="index.php?action=add_user" method="post">
                    <input type="hidden" name="action" value="add_user">
                    <input type="text" name="fullname" placeholder="Fullname">
                    <input type="text" name="username" placeholder="Username">
                    <button type="submit">Ajouter l\'utilisateur</button>
                </form>';
                break;
            default:
                # code...
                break;
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['action']) {
            case 'add_user':
                $sqlAddUser = 'INSERT into user (fullname, username, password, level, followers) VALUES (?, ?, "", 0, 0)';
                $req = $db->prepare($sqlAddUser);
                $req->bindParam(1, $_POST['fullname'], PDO::PARAM_STR);
                $req->bindParam(2, $_POST['username'], PDO::PARAM_STR);
                if ($req->execute()) {
                    $html = "Ajouté";
                }
                break;

            default:
                # code...
                break;
        }
    }*/
} catch (\PDOException $th) {
    die($th->getMessage());
}