<?php

namespace Admin;

use Doctrine\ORM\EntityManager;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\CategoryController::class => function ($container) {
                    return new Controller\CategoryController(
                        $container->get(EntityManager::class),
                        $container->get('formService')
                    );
                },
                Controller\ArticleController::class => function ($container) {
                    return new Controller\ArticleController(
                        $container->get(EntityManager::class),
                        $container->get('formService')
                    );
                },
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'admin_breadcrumb' => Service\AdminBreadcrumbService::class,
            ],
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                'getParentCategoryName' => View\Helper\GetParentCategoryName::class,
                'checkImage' => View\Helper\CheckImage::class,
            ],
        ];
    }
}
