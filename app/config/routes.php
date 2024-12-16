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
        'controller' => 'dashboardController',
        'action' => 'dashboard'
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
        'controller' => 'perfilController',
        'action' => 'perfil'
    ],
    'userList' => [
        'controller' => 'UserListController',
        'action' => 'users'
    ]
]
?>