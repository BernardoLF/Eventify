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
        'action' => 'event'
    ],
    'newEvent' => [
        'controller' => 'NewEventController',
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