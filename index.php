<?php

$routes = require_once 'app/config/routes.php';

// Captura a rota da URL
$uri = trim(string: $_SERVER['REQUEST_URI'], characters: '/');

/* if (array_key_exists(key: $route, array: $routes)){
    $controllerName = $routes[$route]['controller'];
    $actionName = $routes[$route]['action'];
    
    require_once 'app/controllers/' . $controllerName . '.php';  
    
    $controller = new $controllerName();
    
    // Passa o ID do evento para a ação do controlador
    $controller -> $actionName($eventId); 

} else {
     http_response_code(response_code: 404);
     echo 'Página não encontrada';          
} */
foreach ($routes as $route => $routeParams) {
    $pattern = '#^' . $route . '$#';
    if (preg_match($pattern, $uri, $matches)) {
        $controller = $routeParams['controller'];
        $action = $routeParams['action'];

        require_once "./app/controllers/$controller.php";
        $controllerInstance = new $controller();

        if (isset($matches[1])) {
            $controllerInstance->$action($matches[1]);
        } else {
            $controllerInstance->$action();
        }
        exit;
    }
}
echo "Página não encontrada";

?>