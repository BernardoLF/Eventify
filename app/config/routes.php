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
    'event/(\d+)' => [
        'controller' => 'EventController',
        'action' => 'Event'
    ],
    'newEvent' => [
        'controller' => 'EventController',
        'action' => 'newEvent'
    ],
    'utilizadores' => [
        'controller' => 'UtilizadoresController',
        'action' => 'users'
    ]
]
?>