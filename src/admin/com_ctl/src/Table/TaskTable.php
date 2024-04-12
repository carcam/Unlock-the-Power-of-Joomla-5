<?php

namespace AwCo\Component\Ctl\Administrator\Table;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

\defined('_JEXEC') or die;

class TaskTable extends Table
{
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__awco_ctl_tasks', 'id', $db);
	}
}