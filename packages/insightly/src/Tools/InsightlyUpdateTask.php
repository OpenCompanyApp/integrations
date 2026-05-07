<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly task.
 */
class InsightlyUpdateTask extends InsightlyCreateTask
{
    protected string $toolName = 'insightly_update_task';
    protected string $toolDescription = 'Update an Insightly task.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Tasks';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'TASK_ID', 'TITLE', 'DETAILS', 'STATUS', 'PRIORITY', 'DUE_DATE', 'START_DATE', 'COMPLETED', 'PERCENT_COMPLETE', 'OWNER_USER_ID', 'RESPONSIBLE_USER_ID', 'CATEGORY_ID', 'PROJECT_ID', 'OPPORTUNITY_ID', 'MILESTONE_ID', 'ASSIGNED_TEAM_ID', 'CUSTOMFIELDS'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly task ID.'],
        'TITLE' => ['type' => 'string', 'description' => 'Task title.'],
        'DETAILS' => ['type' => 'string', 'description' => 'Task details.'],
        'STATUS' => ['type' => 'string', 'description' => 'Task status.'],
        'PRIORITY' => ['type' => 'integer', 'description' => 'Task priority.'],
        'DUE_DATE' => ['type' => 'string', 'description' => 'Due date.'],
        'START_DATE' => ['type' => 'string', 'description' => 'Start date.'],
        'COMPLETED' => ['type' => 'boolean', 'description' => 'Whether the task is complete.'],
        'PERCENT_COMPLETE' => ['type' => 'integer', 'description' => 'Percent complete.'],
        'OWNER_USER_ID' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'RESPONSIBLE_USER_ID' => ['type' => 'integer', 'description' => 'Responsible user ID.'],
        'CATEGORY_ID' => ['type' => 'integer', 'description' => 'Category ID.'],
        'PROJECT_ID' => ['type' => 'integer', 'description' => 'Related project ID.'],
        'OPPORTUNITY_ID' => ['type' => 'integer', 'description' => 'Related opportunity ID.'],
        'MILESTONE_ID' => ['type' => 'integer', 'description' => 'Related milestone ID.'],
        'ASSIGNED_TEAM_ID' => ['type' => 'integer', 'description' => 'Assigned team ID.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
    ];
}
