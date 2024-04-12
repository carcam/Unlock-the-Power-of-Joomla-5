<?php

use Joomla\CMS\Router\Route;

\defined('_JEXEC') or die;

?>
<?php if ($this->items):?>
<form action="<?php echo Route::_('index.php?option=com_ctl&view=tasks'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="table-responsive">
        <table class="table table-striped">
            <caption>Tasks List</caption>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Task</td>
                    <td>Deadline</td>
                    <td>Created</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->items as $task) :?>
                <tr>
                    <td><?php echo $task->id;?></td>
                    <td>
                        <div class="item-title">
                            <a href="<?php echo Route::_('index.php?option=com_ctl&view=task&layout=edit&id=' . (int) $task->id); ?>">
                                <?php echo $task->title;?>
                            </a>
                        </div>
                        <p class="task-description"><?php echo $task->description;?></p>
                    </td>
                    <td><?php echo $task->deadline;?></td>
                    <td><?php echo $task->created;?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="task" value="">
</form>
<?php else : ?>
<div class="text-large">
    You cleared your inbox. Yeah!!!
</div>
<?php endif;?>
