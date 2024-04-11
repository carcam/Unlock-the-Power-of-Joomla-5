<?php

\defined('_JEXEC') or die('');

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use AwCo\Component\Ctl\Administrator\Extension\CtlComponent;

return new class implements ServiceProviderInterface
{
        public function register(Container $container)
        {
                $container->registerServiceProvider(new MVCFactory('\\AwCo\\Component\\Ctl'));
                $container->registerServiceProvider(new ComponentDispatcherFactory('\\AwCo\\Component\\Ctl'));
                $container->set(
                        ComponentInterface::class,
                        function (Container $container)
                        {
                                $component = new CtlComponent($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                                return $component;
                        }
                );
        }
};