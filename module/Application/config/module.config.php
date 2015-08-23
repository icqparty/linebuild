<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'project' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/project',
                    'defaults' => array(
                        'controller' => 'project',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'action'     => 'add',
                            ),
                        ),
                    ),
                    'setting' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/setting/:id',
                            'defaults' => array(
                                'action'     => 'setting',
                            ),
                        ),
                    ),
                    'key' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/private/:id/key',
                            'defaults' => array(
                                'action'     => 'setting',
                            ),
                        ),
                    ),
                    'view' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/view/:id[/:page]',
                            'defaults' => array(
                                'action'     => 'view',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                )
            ),
            'build' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/build',
                    'defaults' => array(
                        'controller' => 'build',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'rebuild' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/rebuild/:id',
                            'defaults' => array(
                                'action'     => 'rebuild',
                            ),
                        ),
                    ),
                    'view' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/view/:id',
                            'defaults' => array(
                                'action'     => 'view',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                )
            ),
            'user' => array( //all list
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/user',
                    'defaults' => array(
                        'controller' => 'user',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/login',
                            'defaults' => array(
                                'action'     => 'login',
                            ),
                        ),
                    ),
                    'logout' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/logout',
                            'defaults' => array(
                                'action'     => 'logout',
                            ),
                        ),
                    ),
                    'profile' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/profile',
                            'defaults' => array(
                                'action'     => 'profile',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit/:id',
                            'defaults' => array(
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'add' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'action'     => 'add',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'password' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/password',
                            'defaults' => array(
                                'action'     => 'password',
                            ),
                        ),
                    ),
                    'password-code' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/password/code/:code',
                            'defaults' => array(
                                'action'     => 'password-code',
                            ),
                        ),
                    ),
                )
            ),
            'setting' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/setting',
                    'defaults' => array(
                        'controller' => 'setting',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'sc-service' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/sc-service',
                            'defaults' => array(
                                'action'     => 'sc-service',
                            ),
                        ),
                    ),
                    'notification' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/notification',
                            'defaults' => array(
                                'action'     => 'notification',
                            ),
                        ),
                    ),
                )
            )
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'index' => 'Application\Controller\IndexController',
            'project' => 'Application\Controller\ProjectController',
            'build' => 'Application\Controller\BuildController',
            'user' => 'Application\Controller\UserController',
            'setting' => 'Application\Controller\SettingController',
            'command' => 'Application\Controller\CommandController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'onepage/layout'             => __DIR__ . '/../view/layout/onepage.phtml',
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'command' => array(
                    'options' => array(
                        'route' => " <command> [--verbose|-v] [--daemon|-d]",
                        'defaults' => array(
                            'controller' => 'command',
                            'action' => 'index',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
