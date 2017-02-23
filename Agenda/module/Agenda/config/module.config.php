<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Agenda;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router'       => [
        'routes' => [
            'home'        => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'contacto' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/contacto[/:action]',
                    'defaults' => [
                        'controller' => Controller\ContactoController::class,
                        'action'     => 'showContacto',
                    ],
                ],
            ],
            'categoria' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/categoria[/:action]',
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'showCategoria',
                    ],
                ],
            ],
        ],
    ],
    'controllers'  => [
        'factories' => [
            Controller\IndexController::class   => InvokableFactory::class,
            Controller\ContactoController::class   => InvokableFactory::class,
            Controller\CategoriaController::class   => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout'      => __DIR__ . '/../view/layout/layout.phtml',
            //'agenda/index/index' => __DIR__ . '/../view/agenda/index/index.phtml',
            'error/404'          => __DIR__ . '/../view/error/404.phtml',
            'error/index'        => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
];
