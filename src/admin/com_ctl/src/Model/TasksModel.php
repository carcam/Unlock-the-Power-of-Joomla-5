<?php

namespace AwCo\Component\Ctl\Administrator\Model;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

\defined('_JEXEC') or die;

class TasksModel extends ListModel
{
    protected function getListQuery()
    {
        $db	= $this->getDatabase();
        $query = $db->getQuery(true);
        $query->select(
            $this->getState('list.select',
                [
                    $db->quoteName('a.id'),
                    $db->quoteName('a.title'),
                    $db->quoteName('a.state'),
                    $db->quoteName('a.description'),
                    $db->quoteName('a.deadline'),
                    $db->quoteName('a.created'),
                ]
            )
        )->from($db->quoteName('#__awco_ctl_tasks', 'a'));

        $orderCol = $this->state->get('list.ordering', 'a.created');
        $orderDirn = $this->state->get('list.direction', 'ASC');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }
}