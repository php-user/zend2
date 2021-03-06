<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Doctrine\ORM\EntityManager;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                'getYear' => View\Helper\GetYear::class,
            ],
            'factories' => [
                'getCategory' => function ($container) {
                    return new View\Helper\GetCategory(
                        $container->get(EntityManager::class)
                    );
                },
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'topNavigation' => Service\TopNavigationService::class,
            ],
            'invokables' => [
                'formService' => Service\FormService::class,
            ],
        ];
    }

    public function getControllerPluginConfig()
    {
        return [
            'invokables' => [
                'clearString'     => Controller\Plugin\ClearString::class,
                'stringValidator' => Controller\Plugin\StringValidator::class,
                'isObjectExists'  => Controller\Plugin\IsObjectExists::class,
            ],
        ];
    }
}
