<?php

return[
    '' => [
        'controller' => 'AuthController', // Controlador para a página inicial
        'action' => 'login' // Ação de login
    ],
    'register' => [
        'controller' => 'AuthController', // Controlador para registro de usuários
        'action' => 'register' // Ação de registro
    ],
    'dashboard' => [
        'controller' => 'DashboardController', // Controlador para o painel do usuário
        'action' => 'index' // Ação que exibe o painel
    ],
    'event/(\d+)' => [
        'controller' => 'EventController', // Controlador para eventos
        'action' => 'Event' // Ação que exibe um evento específico
    ],
    'newEvent' => [
        'controller' => 'EventController', // Controlador para criação de novos eventos
        'action' => 'newEvent' // Ação para criar um novo evento
    ],
    'utilizadores' => [
        'controller' => 'UtilizadoresController', // Controlador para gerenciamento de usuários
        'action' => 'users' // Ação que lista os usuários
    ],
    'logout' => [ 
        'controller' => 'DashboardController',
        'action' => 'logout'
    ]
]
?>