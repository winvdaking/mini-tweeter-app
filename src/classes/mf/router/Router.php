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
        if (empty($this->request->get['action'])) {
            $default = new self::$routes[self::$aliases['default']];
            $default->execute();
        } else {
            $action = self::$routes[$this->request->get['action']];
            if (isset($action)) {
                $action = new $action;
                $action->execute();
            } else {
                $default = new self::$routes[self::$aliases['default']];
                $default->execute();
            }
        }
    }

    public function setDefaultRoute(string $action): void
    {
        self::$aliases['default'] = $action;
    }

    /*
     * Méthode urlFor : retourne l'URL d'une route depuis son alias
     * cette méthode est utile pour écrire les lien HTML et les action
     * des formulaire. Elle permet de générer la valeur href ppour les
     * balise <a href="...">lien</a> 
     * 
     * Paramètres :
     * 
     * - $name : alias de la route (clé du tableau self::$aliases) 
     * - $params (optionnel) : la liste des paramètres si l'URL
     *      prend des paramètres dans le querry string. Chaque paramètre
     *      est représenté sous la forme d'un tableau avec 2 entrées :
     *      le nom du paramètre et sa valeur  
     *
     * Algorthme:
     *
     * - Déduire l'action de la route demandée (dans self::$aliases)
     * - Construire depuis le nom du script et l'action 
     *   l'URL relatif (ex: "/le/chemin/../main.php?action=...")
     * - Si $params est fournit
     *      - Ajouter les paramètres du query string à l'URL complète
     *         (ex: "/le/chemin/../main.php?action=...&...=...&...=...")
     * - retourner l'URL
     *
     */
    public function urlFor(string $name, array $params = []): string
    {
        $url = self::$aliases[$name];
        var_dump($url);
        return '';
    }

    public static function executeRoute($alias): void
    {
        $route = new self::$routes[self::$aliases[$alias]];
        $$route->execute();
    }
}
