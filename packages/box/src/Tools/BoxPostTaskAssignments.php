<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Assign task.
 *
 * Executes the official Box API operation post_task_assignments.
 */
class BoxPostTaskAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_task_assignments';
}
