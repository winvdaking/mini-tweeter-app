<?php

require_once 'vendor/autoload.php';

use \iutnc\mf\router\Router;

class DummyCtrl
{
    public function execute()
    {
        echo "it's me dummy !";
    }
}

class RouterTest extends \PHPUnit\Framework\TestCase
{


    public function __construct()
    {
        parent::__construct();
        $this->makeFakeData();
    }


    private function makeFakeData()
    {
        // constructs a fake SERVER variable.
        // URL = http://localhost/tweeter/test.php/stuff/morestuff/?id=15

        $_SERVER['SCRIPT_NAME'] = '/tweeter/test.php';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['PATH_INFO'] = '/stuff/morestuff/';
        $_GET['id'] = '15';
        $_POST['text'] = 'Un texte.';
    }


    public function testSubclass()
    {
        $this->assertTrue(
            is_subclass_of('\iutnc\mf\router\Router', '\iutnc\mf\router\AbstractRouter'),
            "FEEDBACK : La class Router doit concrétiser AbstractRouter"
        );
    }


    public function getPrivateProperty($className, $propertyName)
    {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

    public function testAddRoute()
    {
        $name = "dummy_name";
        $action = "dummy_action";
        $ctrl = "\dummy\app\control\Controller";

        $r = new Router();
        $r->addRoute($name, $action, $ctrl);

        $routes = $this->getPrivateProperty('\iutnc\mf\router\Router', 'routes')->getValue($r);
        $aliases = $this->getPrivateProperty('\iutnc\mf\router\Router', 'aliases')->getValue($r);

        $this->assertTrue(
            array_key_exists($action, $routes),
            "FEEDBACK : le tableau self::\$routes doit avoir les URL comme clé"
        );
        $this->assertTrue(
            $routes[$action] === $ctrl,
            "FEEDBACK : les valeur de self::\$routes doivent etre les noms des class controlleur."
        );

        $this->assertTrue(
            array_key_exists($name, $aliases),
            "FEEDBACK : le tableau self::\$alises doit avoir les noms des routes comme clé"
        );

        $this->assertTrue(
            $aliases[$name] === $action,
            "FEEDBACK : le tableau self::\$alises doit associer les nom a l'action."
        );
    }

    public function testSetDefaultRoute()
    {
        $name = "dummy_name";
        $action = "dummy_path";
        $ctrl = "\dummy\app\control\Controller";
        $mth = "doDummyWork";

        $r = new Router();
        $r->addRoute($name, $action, $ctrl);

        $r->setDefaultRoute($action);

        $aliases = $this->getPrivateProperty('\iutnc\mf\router\Router', 'aliases')->getValue($r);
        $this->assertTrue(
            array_key_exists('default', $aliases),
            "FEEDBACK : la route par défaut doit être enregistrée sous la clé 'default' dans tableau self::\$alises"
        );
        $this->assertTrue(
            $aliases['default'] === $action,
            "FEEDBACK : le tableau self::\$alises doit associer la clé 'default'.a l'action de la route par défaut"
        );
    }


    public function testRun()
    {

        $name = "dummy_name";
        $action = "dummy_path";
        $ctrl = "DummyCtrl";
        $mth = "dummyMeth";
        $r = new Router();
        $r->addRoute($name, $action, $ctrl);

        $expected = "it's me dummy !";

        $this->expectOutputString($expected, "FEEDBACK : la méthode run doit exécuter le méthode du contrôleur de la route demandée dans le PATH_INFO.\nE.g. : si url = \"http://localhost/Tweeter/main.php/home/\",  run doit exécuter view_home sur une instance de TweeterController.");


        $_GET['action'] = $action;

        $r->run();
    }


    public function testExecuteRoute()
    {

        $name = "dummy_name";
        $action = "dummy_path";
        $ctrl = "DummyCtrl";
        $mth = "dummyMeth";
        $r = new Router();
        $r->addRoute($name, $action, $ctrl);

        $expected = "it's me dummy !";

        Router::executeRoute('dummy_name');

        $this->expectOutputString($expected, "FEEDBACK : la méthode run doit exécuter le méthode du contrôleur de la route demandée dans le PATH_INFO.\nE.g. : si url = \"http://localhost/Tweeter/main.php/home/\",  run doit exécuter view_home sur une instance de TweeterController.");
    }
    
    public function testUrlFor()
    {

        $name = "dummy_name";
        $action = "dummy_path";
        $ctrl = "\dummy\app\control\Controller";
        $mth = "doDummyWork";

        $r = new Router();
        $r->addRoute($name, $action, $ctrl);



        $expected = $_SERVER['SCRIPT_NAME'] . "?action=" . $action;

        $this->assertEquals(
            $r->urlFor($name),
            $expected,
            "FEEDBACK : La méthode urlFor doit retourner l'url complète de la route nommée.\nE.g. : urlFor('home') retourne \"/Tweeter/main.php?action=list_tweets\""
        );


        $expected .= "&amp;id=12&amp;user=john";
        
        $this->assertEquals(
            $r->urlFor($name, [['id',  12], ['user', 'john']]),
            $expected,
            "FEEDBACK : La méthode urlFor doit retourner l'url complète de la route nommée.\nE.g. : urlFor('view', [ ['id', 12] ]) retourne \"/Tweeter/main.php?action=view_tweet&amp;id=12\""
        );
        
    }
    
}
