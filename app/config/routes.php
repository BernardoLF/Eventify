<?php

return[
    '' => [
        'controller' => 'AuthController',
        'action' => 'login'
    ],
    'register' => [
        'controller' => 'AuthController',
        'action' => 'register'
    ],
    'dashboard' => [
        'controller' => 'DashboardController',
        'action' => 'index'
    ],
    'event' => [
        'controller' => 'EventController',
        'action' => 'index'
    ],
    'newEvent' => [
        'controller' => 'EventController',
        'action' => 'newEvent'
    ],
    'perfil' => [
        'controller' => 'PerfilController',
        'action' => 'perfil'
    ],
    'userList' => [
        'controller' => 'UserListController',
        'action' => 'users'
    ]
]
?>