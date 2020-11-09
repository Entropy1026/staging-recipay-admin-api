<?php
return [
    'service_manager' => [
        'factories' => [
            \RecipayMobileOrder\Domain\Order\OrderRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayMobileOrder\Domain\Cart\CartRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayMobileOrder\Domain\Payment\PaymentRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            \RecipayMobileOrder\V1\Rpc\Order\OrderController::class => \RecipayMobileOrder\V1\Rpc\Order\OrderControllerFactory::class,

        ],
    ],
    'router' => [
        'routes' => [
            'recipay-mobile-order.rpc.order' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/open/order/:action',
                    'defaults' => [
                        'controller' => \RecipayMobileOrder\V1\Rpc\Order\OrderController::class,
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'recipay-mobile-order.rpc.order',
        ],
    ],
    'zf-rpc' => [
        'RecipayMobileOrder\\V1\\Rpc\\Order\\Controller' => [
            'service_name' => 'Order',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-mobile-order.rpc.order',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            \RecipayMobileOrder\V1\Rpc\Order\OrderController::class => 'Json',

        ],
        'accept_whitelist' => [
            'RecipayMobileOrder\\V1\\Rpc\\Order\\Controller' => [
                0 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'RecipayMobileOrder\\V1\\Rpc\\Order\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
];
