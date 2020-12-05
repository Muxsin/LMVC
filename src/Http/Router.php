<?php

namespace LMVC\Http;

use LMVC\Support\Bag;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = new Bag();
    }

    public function set(string $name, Route $route): self
    {
        $this->routes->set($name, $route);

        return $this;
    }

    public function handle(Request $request): Response
    {
        $response = abort(404, 'Not Found');

        foreach ($this->routes as $route) {
            /**
             * @var Route $route
             */

            if ($route->check($request)) {
                $controllerName = $route->getControllerName();
                $actionName = $route->getActionName();

                if (method_exists($controllerName, $actionName)) {
                    $controller = new $controllerName();
                    $response = $controller->$actionName($request);

                    if (!$response instanceof Response) {
                        $response = new Response($response . '');
                    }
                } else {
                    $response = abort(500, 'Server Error');
                }

                break;
            }
        }

        return $response;
    }
}
