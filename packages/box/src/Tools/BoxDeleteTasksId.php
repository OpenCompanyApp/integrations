<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove task.
 *
 * Executes the official Box API operation delete_tasks_id.
 */
class BoxDeleteTasksId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_tasks_id';
}
