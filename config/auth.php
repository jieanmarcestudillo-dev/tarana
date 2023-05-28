<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'employeesModel' => [
            'driver' => 'session',
            'provider' => 'employeesModel',
        ],

        'operationModel' => [
            'driver' => 'session',
            'provider' => 'operationModel',
        ],

        'applicantsModel' => [
            'driver' => 'session',
            'provider' => 'applicantsModel',
        ],

        'blockedApplicants' => [
            'driver' => 'session',
            'provider' => 'blockedApplicants',
        ],
        
        'appliedModel' => [
            'driver' => 'session',
            'provider' => 'appliedModel',
        ],

        'backOutModel' => [
            'driver' => 'session',
            'provider' => 'backOutModel',
        ],

        'declinedModel' => [
            'driver' => 'session',
            'provider' => 'declinedModel',
        ],

        'completed' => [
            'driver' => 'session',
            'provider' => 'completed',
        ],

        'historyModel' => [
            'driver' => 'session',
            'provider' => 'historyModel',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'employeesModel' => [
            'driver' => 'eloquent',
            'model' => App\Models\employees::class
        ],

        'operationModel' => [
            'driver' => 'eloquent',
            'model' => App\Models\operations::class
        ],
        
        'applicantsModel' => [
            'driver' => 'eloquent',
            'model' => App\Models\applicants::class
        ],

        'blockedApplicants' => [
            'driver' => 'eloquent',
            'model' => App\Models\blockedApplicants::class
        ],

        'appliedModel' => [
            'driver' => 'eloquent',
            'model' => App\Models\applied::class
        ],

        'backOutModel' => [
            'driver' => 'eloquent',
            'model' => App\Models\backout::class
        ],

        'declinedModel' => [
            'driver' => 'eloquent',
            'model' => App\Models\declined::class
        ],

        'completed' => [
            'driver' => 'eloquent',
            'model' => App\Models\completed::class
        ],

        'historyModel' => [
            'driver' => 'eloquent',
            'model' => App\Models\history::class
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
