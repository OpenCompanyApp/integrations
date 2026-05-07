<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update task assignment.
 *
 * Executes the official Box API operation put_task_assignments_id.
 */
class BoxPutTaskAssignmentsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_task_assignments_id';
}
