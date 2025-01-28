<?php

namespace AwCo\Component\Ctl\Administrator\Extension;

use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Psr\Container\ContainerInterface;

\defined('_JEXEC') or die;

class CtlComponent extends MVCComponent implements
    BootableExtensionInterface
{
        public function boot(ContainerInterface $container)
        {
        }
}