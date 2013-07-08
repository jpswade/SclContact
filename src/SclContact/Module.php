<?php
/**
 * SclContact (https://github.com/SCLInternet/SclContact)
 *
 * @link https://github.com/SCLInternet/SclContact for the canonical source repository
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace SclContact;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\ModuleManager\Feature\HydratorProviderInterface;

/**
 * Zend Framework 2 module class which provide hydrators and filters when
 * using SclContact in a ZF2 project.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Module implements
    AutoloaderProviderInterface,
    FilterProviderInterface,
    HydratorProviderInterface
{
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getFilterConfig()
    {
        return array();
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getHydratorConfig()
    {
        return array(
            'invokables' => array(
                'SclContact\Hydrator\AddressHydrator' => 'SclContact\Hydrator\AddressHydrator',
            ),
            'factories' => array(
                'SclContact\Hydrator\ContactHydrator' => function ($sm) {
                    return new \SclContact\Hydrator\ContactHydrator(
                        $sm->get('SclContact\Hydrator\AddressHydrator')
                    );
                },
            ),
        );
    }
}
