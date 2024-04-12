<?php

namespace AwCo\Component\Ctl\Api\View\Tasks;

use Joomla\CMS\MVC\View\JsonApiView as BaseApiView;

class JsonapiView extends BaseApiView
{
	protected $fieldsToRenderList = [
        'id',
        'title',
        'description',
        'deadline'
	];

        protected $fieldsToRenderItem = [
        'id',
        'title',
        'description',
        'deadline'
	];
}