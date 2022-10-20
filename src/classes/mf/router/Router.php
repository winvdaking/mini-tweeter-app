<?php

namespace iutnc\mf\router;

class Router extends AbstractRouter
{

    public function addRoute(string $name, string $action, string $ctrl): void
    {
        self::$aliases[$name] = $action;
        self::$routes[$action] = $ctrl;
    }


    /*
     * Méthode run : exécuter une route en fonction de la requête 
     *    (l'action est récupérée depuis l'attribut $this->request)
     *
     * Algorithme :
     * 
     * - si le query string ne contient pas le paramètre action
     *    - exécuter la route par défaut
     * - sinon
     *    - Récupérer la valeur de action
     *    - si une route existe dans $self::routes sous cette cette clé.
     *        - exécuter cette route
     *    - sinon exécuter la route par defaut
     * 
     * Note : exécuter une route revient a instancier le contrôleur
     *        de la route et exécuter sa méthode execute
     */
    
    public function run(): void
    {
        var_dump($this->request->get);
        if (empty($this->request->get)) {
            $default = new self::$routes[self::$aliases['default']];
            $default->execute();
        }else{

        }
    }

    public function setDefaultRoute(string $action): void
    {
        self::$aliases['default'] = $action;
    }

    public function urlFor(string $name, array $params = []): string
    {
        return '';
    }

    public static function executeRoute($alias): void{

    }
}
