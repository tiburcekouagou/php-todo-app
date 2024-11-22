<?php
namespace App\Controllers;

class Controller
{
    /**
     * Méthode pour charger une vue
     * @param string $view Nom de la vue (fichier PHP)
     * @param mixed $data Données à transmettre à la vue
     * @return void
     */
    protected function view(string $view, $data = []) {
        extract($data);
        require dirname(__DIR__) . "/Views/$view.php";
    }
    
    
    /**
     * Méthode pour rediriger vers une URL
     * @param string $url URL de redirection
     * @return never
     */
    protected function redirect(string $url)
    {
        header(header: "Location: $url");
        exit;
    }
}