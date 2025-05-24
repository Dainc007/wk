<?php

declare(strict_types=1);

return [
    'pages' => [
        'dashboard' => 'Panel',
    ],
    'resources' => [
        'user' => [
            'navigation' => [
                'label' => 'Użytkownicy',
            ],
            'model' => [
                'label' => 'Użytkownik',
                'plural_label' => 'Użytkownicy',
            ],
        ],
        'team' => [
            'navigation' => [
                'label' => 'Drużyny',
            ],
            'model' => [
                'label' => 'Drużyna',
                'plural_label' => 'Drużyny',
            ],
        ],
        'activitylog' => [
            'navigation' => [
                'label' => 'Dziennik aktywności',
            ],
            'model' => [
                'label' => 'Wpis dziennika',
                'plural_label' => 'Dziennik aktywności',
            ],
        ],
        'league' => [
            'navigation' => [
                'label' => 'Ligi',
            ],
            'model' => [
                'label' => 'Liga',
                'plural_label' => 'Ligi',
            ],
        ],
        'teamuser' => [
            'navigation' => [
                'label' => 'Użytkownicy drużyn',
            ],
            'model' => [
                'label' => 'Użytkownik drużyny',
                'plural_label' => 'Użytkownicy drużyn',
            ],
        ],
        'game' => [
            'navigation' => [
                'label' => 'Mecze',
            ],
            'model' => [
                'label' => 'Mecz',
                'plural_label' => 'Mecze',
            ],
        ],
        'federation' => [
            'navigation' => [
                'label' => 'Federacje',
            ],
            'model' => [
                'label' => 'Federacja',
                'plural_label' => 'Federacje',
            ],
        ],
    ],
];
