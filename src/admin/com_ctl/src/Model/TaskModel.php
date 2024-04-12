<?php

namespace AwCo\Component\Ctl\Administrator\Model;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

\defined('_JEXEC') or die;

class TaskModel extends AdminModel
{

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_ctl.task',
            'task',
            [
                'control' => 'jform',
                'load_data' => $loadData
            ]
        );
        
            if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
	{
		$app = Factory::getApplication();
		$data = $app->getUserState(
			'com_ctl.edit.task.data',
			[]
		);
		if (empty($data)) {
			$data = $this->getItem();
		}
		return $data;
    }
}