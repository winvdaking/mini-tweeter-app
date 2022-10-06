<?php

$server = 'localhost';
$dbname = 'dorian';
$user = 'admin';
$pass = 'admin';

$dsn = "mysql:host={$server};dbname=${dbname}";

try {
    $db = new \PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

    $sqlTweets = 'SELECT * FROM tweet';
    $tweets = $db->query($sqlTweets);

    echo "Tweets :<br>";
    while($ligne = $tweets->fetch()){
        echo $ligne['id'] . " - " . $ligne['text'] . "<br>";
    }


    $sqlUsers = 'SELECT * FROM user';
    $users = $db->query($sqlUsers);

    echo "<br>Users :<br>";
    while($ligne = $users->fetch()){
        echo $ligne['id'] . '. ' . $ligne['username'] . " - " . $ligne['fullname'] . "<br>"; 
    }

    $sqlTweetAlbert = "SELECT * FROM tweet WHERE author = (SELECT id FROM user WHERE username = 'albert')";
    $tweetsAlbert = $db->query($sqlTweetAlbert);

    echo "<br>Tweets from Albert : <br>";
    while($ligne = $tweetsAlbert->fetch()){
        echo $ligne['id'] . " - " . $ligne['text'] . "<br>";
    }

    $sqlEditAuthor = 'UPDATE tweet set author = 8 WHERE id = 49';
    $db->exec($sqlEditAuthor);

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

    $id = 50;
    $sqlDeleteTweet = 'DELETE FROM tweet WHERE id = :id';
    $reqDlt = $db->prepare($sqlDeleteTweet);
    $reqDlt->bindParam(':id', $id, PDO::PARAM_INT);
    if($reqDlt->execute()){
        echo "Supprimé";
    }

    

} catch (\PDOException $th) {
    die($th->getMessage());
}