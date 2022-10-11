<?php

$server = 'localhost';
$dbname = 'dorian';
$user = 'admin';
$pass = 'admin';

$dsn = "mysql:host={$server};dbname=${dbname}";

/*
$fullname = 'Dorian Lopez';
$usrname = 'dorian';
$lvl = 100;
$pwd = 'dorian';
$flw = 3;
$sqlAddUser = 'INSERT into user (id, fullname, username, password, level, followers) VALUES (11 ,:fn, :usr, :pswd, :lvl, :flw)';
$req = $db->prepare($sqlAddUser);
$req->bindParam(':fn', $fullname, PDO::PARAM_STR);
$req->bindParam(':usr', $usrname, PDO::PARAM_STR);
$req->bindParam(':pswd', $pwd, PDO::PARAM_STR);
$req->bindParam(':lvl', $lvl, PDO::PARAM_INT);
$req->bindParam(':flw', $flw, PDO::PARAM_INT);
if($req->execute()){
echo "Ajouté";
}

*/

try {
    $db = new \PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        switch ($_GET['action']) {
            case 'all_tweets':
                $sqlTweets = 'SELECT id, text FROM tweet';
                $tweets = $db->query($sqlTweets);

                $html = "Tweets :<br>";
                while ($ligne = $tweets->fetch()) {
                    $html .= $ligne['id'] . " - " . $ligne['text'] . "<br>";
                }
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
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    }
} catch (\PDOException $th) {
    die($th->getMessage());
}
echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php?action=all_tweets">Afficher les Tweets</a></li>
            <li><a href="index.php?action=all_users">Afficher les Users</a></li>
            <li><a href="index.php?action=add_user">Ajouter un utilisateur</a></li>
        </ul>
    </nav>
     ' . $html . '
</body>

</html>';