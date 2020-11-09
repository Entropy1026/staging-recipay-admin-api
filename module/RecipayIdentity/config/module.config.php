<?php
return [
    'service_manager' => [
        'factories' => [
          \RecipayIdentity\Domain\User\UserRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
          \RecipayIdentity\Domain\Billing\BillingRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
       
        ],
    ],
    'controllers' => [
        'factories' => [
            \RecipayIdentity\V1\Rpc\Users\UsersController::class => \RecipayIdentity\V1\Rpc\Users\UsersControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'recipay-identity.rpc.users' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/open/users/:action',
                    'defaults' => [
                        'controller' => \RecipayIdentity\V1\Rpc\Users\UsersController::class,
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'recipay-identity.rpc.users',
        ],
    ],
    'zf-rpc' => [
        'RecipayIdentity\\V1\\Rpc\\Users\\Controller' => [
            'service_name' => 'Users',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-identity.rpc.users',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            \RecipayIdentity\V1\Rpc\Users\UsersController::class => 'Json',
            'RecipayIdentity\\V1\\Rpc\\Users\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'RecipayIdentity\\V1\\Rpc\\Users\\Controller' => [
                0 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'RecipayIdentity\\V1\\Rpc\\Users\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
];
