<?php
return [
    'service_manager' => [
        'factories' => [
            \RecipayAdmin\Domain\Product\ProductRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Ratings\RatingRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Ingredient\IngredientRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Category\CategoryRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Favorites\FavoriteRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Action\ActionRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Advertisement\AdvertisementRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Messages\MessagesRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Menu\MenuRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Cuisine\CuisineRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\IngredientsItem\IngredientsItemRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
            \RecipayAdmin\Domain\Product\ProductIngredientsRepository::class => \Application\Infra\Repository\RepositoryFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            \RecipayAdmin\V1\Rpc\Products\ProductsController::class => \RecipayAdmin\V1\Rpc\Products\ProductsControllerFactory::class,
            \RecipayAdmin\V1\Rpc\ProductCategory\ProductCategoryController::class => \RecipayAdmin\V1\Rpc\ProductCategory\ProductCategoryControllerFactory::class,
            \RecipayAdmin\V1\Rpc\Advertisement\AdvertisementController::class => \RecipayAdmin\V1\Rpc\Advertisement\AdvertisementControllerFactory::class,
            \RecipayAdmin\V1\Rpc\Dispute\DisputeController::class => \RecipayAdmin\V1\Rpc\Dispute\DisputeControllerFactory::class,
            \RecipayAdmin\V1\Rpc\CuisineTypes\CuisineTypesController::class => \RecipayAdmin\V1\Rpc\CuisineTypes\CuisineTypesControllerFactory::class,
            \RecipayAdmin\V1\Rpc\IngredientsItem\IngredientsItemController::class => \RecipayAdmin\V1\Rpc\IngredientsItem\IngredientsItemControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'recipay-admin.rpc.products' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/admin/products/:action',
                    'defaults' => [
                        'controller' => \RecipayAdmin\V1\Rpc\Products\ProductsController::class,
                    ],
                ],
            ],
            'recipay-admin.rpc.product-category' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/admin/product/category/:action',
                    'defaults' => [
                        'controller' => \RecipayAdmin\V1\Rpc\ProductCategory\ProductCategoryController::class,
                    ],
                ],
            ],
            'recipay-admin.rpc.advertisement' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/admin/ads/:action',
                    'defaults' => [
                        'controller' => \RecipayAdmin\V1\Rpc\Advertisement\AdvertisementController::class,
                    ],
                ],
            ],
            'recipay-admin.rpc.dispute' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/admin/dispute/:action',
                    'defaults' => [
                        'controller' => \RecipayAdmin\V1\Rpc\Dispute\DisputeController::class,
                    ],
                ],
            ],
            'recipay-admin.rpc.cuisine-types' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/admin/cuisine/:action',
                    'defaults' => [
                        'controller' => \RecipayAdmin\V1\Rpc\CuisineTypes\CuisineTypesController::class,
                    ],
                ],
            ],
            'recipay-admin.rpc.ingredients-item' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/admin/ingredients/item/:action',
                    'defaults' => [
                        'controller' =>  \RecipayAdmin\V1\Rpc\IngredientsItem\IngredientsItemController::class,
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'recipay-admin.rpc.products',
            1 => 'recipay-admin.rpc.product-category',
            2 => 'recipay-admin.rpc.advertisement',
            3 => 'recipay-admin.rpc.dispute',
            4 => 'recipay-admin.rpc.cuisine-types',
            5 => 'recipay-admin.rpc.ingredients-item',
        ],
    ],
    'zf-rpc' => [
        'RecipayAdmin\\V1\\Rpc\\Products\\Controller' => [
            'service_name' => 'products',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-admin.rpc.products',
        ],
        'RecipayAdmin\\V1\\Rpc\\ProductCategory\\Controller' => [
            'service_name' => 'ProductCategory',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-admin.rpc.product-category',
        ],
        'RecipayAdmin\\V1\\Rpc\\Advertisement\\Controller' => [
            'service_name' => 'Advertisement',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-admin.rpc.advertisement',
        ],
        'RecipayAdmin\\V1\\Rpc\\Dispute\\Controller' => [
            'service_name' => 'Dispute',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-admin.rpc.dispute',
        ],
        'RecipayAdmin\\V1\\Rpc\\CuisineTypes\\Controller' => [
            'service_name' => 'CuisineTypes',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-admin.rpc.cuisine-types',
        ],
        'RecipayAdmin\\V1\\Rpc\\IngredientsItem\\Controller' => [
            'service_name' => 'IngredientsItem',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'recipay-admin.rpc.ingredients-item',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            \RecipayAdmin\V1\Rpc\Products\ProductsController::class => 'Json',
            \RecipayAdmin\V1\Rpc\ProductCategory\ProductCategoryController::class => 'Json',
            \RecipayAdmin\V1\Rpc\Advertisement\AdvertisementController::class => 'Json',
            \RecipayAdmin\V1\Rpc\Dispute\DisputeController::class => 'Json',
            'RecipayAdmin\\V1\\Rpc\\ProductCategory\\Controller' => 'Json',
            \RecipayAdmin\V1\Rpc\CuisineTypes\CuisineTypesController::class => 'Json',
            'RecipayAdmin\\V1\\Rpc\\CuisineTypes\\Controller' => 'Json',
            'RecipayAdmin\\V1\\Rpc\\IngredientsItem\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'RecipayAdmin\\V1\\Rpc\\Products\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\ProductCategory\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\Advertisement\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\Dispute\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\CuisineTypes\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\IngredientsItem\\Controller' => [
                0 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'RecipayAdmin\\V1\\Rpc\\Products\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\ProductCategory\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\Advertisement\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\Dispute\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\CuisineTypes\\Controller' => [
                0 => 'application/json',
            ],
            'RecipayAdmin\\V1\\Rpc\\IngredientsItem\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
];
