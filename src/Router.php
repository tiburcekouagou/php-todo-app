<?php
namespace App;

class Router {
    private $routes = [];

    public function get(string $url, callable $action) {
        $this->addRoute('GET', $url, $action);
    }
    public function post(string $url, callable $action) {
        $this->addRoute('POST', $url, $action);
    }

    private function addRoute(string $method, string $url, callable $action) {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'action' => $action
        ];
    }

    public function resolve() {}
}
