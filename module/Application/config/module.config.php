<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014-2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Application;
use Zend\ServiceManager\Factory\InvokableFactory;
use Application\Infrastructure\Repository\RepositoryFactory;
return [  
    'service_manager' => [
        'factories' => [
        ],
    ],
    'doctrine' => [
    'driver' => [
        'recipay_driver' => [
            'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
            'cache' => 'array',
            'paths' => [
                __DIR__ . '/../../RecipayAdmin/src/Infra/Entity',
                __DIR__ . '/../../RecipayIdentity/src/Infra/Entity',
                __DIR__ . '/../../RecipayMobileOrder/src/Infra/Entity'
                
            ],
        ],  
        'orm_default' => [
            'drivers' => [
                'RecipayAdmin\\Infra\\Entity' => 'recipay_driver',
                'RecipayIdentity\\Infra\\Entity' => 'recipay_driver',
                'RecipayMobileOrder\\Infra\\Entity' => 'recipay_driver',
            ],
        ],
    ],
],
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,

                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
