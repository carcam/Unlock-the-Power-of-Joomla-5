<?php

namespace AwCo\Plugin\WebServices\Ctl\Extension;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Router\ApiRouter;
use Joomla\Router\Route;

\defined('_JEXEC') or die;


final class Ctl extends CMSPlugin
{
    public function onBeforeApiRoute(&$router)
    {
        $route = new Route(
            ['GET'],
			'v1/ctl/tasks/:id',
			'tasks.displayItem',
			['id' => '(\d+)'],
			['component' => 'com_ctl']
		);
        $router->addRoute($route);

        $router->createCRUDRoutes(
            'v1/ctl/tasks',
            'tasks.displayList',
            ['component' => 'com_ctl']
        );
    }

}
