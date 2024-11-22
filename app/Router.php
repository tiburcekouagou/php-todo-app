<?php
namespace App;

/**
 * Classe Router
 * Gère l'enregistrement et la résolution des routes pour notre application web.
 * Permet de définir des routes HTTP et d'exécuter les actions correspondantes
 * en fonction des requêtes entrantes.
 */
class Router {
    // Propriété privée pour stocker les routes enregistrées.
    private $routes = [];

    /**
     * Enregistre une route GET.
     * 
     * @param string $url URL de la route (ex: "/home").
     * @param callable $action Fonction ou méthode à exécuter si la route correspond.
     * @return void
     */
    public function get(string $url, callable $action) {
        $this->addRoute('GET', $url, $action);
    }

    /**
     * Enregistre une route POST.
     * 
     * @param string $url URL de la route (ex: "/delete").
     * @param callable $action Fonction ou méthode à exécuter si la route correspond.
     * @return void
     */
    public function post(string $url, callable $action) {
        $this->addRoute('POST', $url, $action);
    }

    /**
     * Ajoute une route à la liste des routes.
     * 
     * @param string $method Méthode HTTP (GET, POST, etc.).
     * @param string $url URL de la route.
     * @param callable $action Action à exécuter (fonction ou méthode).
     * @return void
     */
    private function addRoute(string $method, string $url, callable $action) {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'action' => $action
        ];
    }

    /**
     * Résout la requête entrante en fonction des routes enregistrées.
     * 
     * - Compare l'URL et la méthode HTTP de la requête avec chaque route enregistrée.
     * - Si une correspondance est trouvée, l'action associée est exécutée.
     * - Sinon, une erreur 404 est retournée
     * 
     * @return void
     */
    public function resolve() {
        // Récupérer l'URL depuis la requête
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Récupérer la méthode HTTP utilisée pour la requête.
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Parcourir toutes les routes enregistrées.
        foreach($this->routes as $route) {
            // Vérifier si l'URL et la méthode HTTP correspondent à la route actuelle.
            if ($route['url'] === $requestUrl && $route['method'] === $requestMethod) {
                // si une correspondance est trouvée, exécute l'action associée.
                call_user_func($route['action']);
                return; // Termine la méthode après avoir exécuté l'action
            }
        }

        // Si aucune correspondance n'est trouvée, retourner une erreur 404.
        http_response_code(404);
        echo "404 Page Non Trouvée !";
    }
}
