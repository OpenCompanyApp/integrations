<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Unassign task.
 *
 * Executes the official Box API operation delete_task_assignments_id.
 */
class BoxDeleteTaskAssignmentsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_task_assignments_id';
}
