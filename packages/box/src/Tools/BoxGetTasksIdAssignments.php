<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List task assignments.
 *
 * Executes the official Box API operation get_tasks_id_assignments.
 */
class BoxGetTasksIdAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_tasks_id_assignments';
}
