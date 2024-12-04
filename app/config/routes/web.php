<?php

require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../database/database.php';

$authController = new AuthController($pdo);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/login' && $method === 'GET') {
    $authController->showLogin();
} elseif ($uri === '/login' && $method === 'POST') {
    $authController->login();
} elseif ($uri === '/register' && $method === 'GET') {
    $authController->showRegister();
} elseif ($uri === '/register' && $method === 'POST') {
    $authController->register();
} else {
    echo "Página não encontrada.";
}
