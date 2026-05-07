<?php

namespace OpenCompany\Integrations\MicrosoftPlanner\Tools;

/**
 * Get progressTaskBoardFormat from users.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /users/{user-id}/planner/tasks/{plannerTask-id}/progressTaskBoardFormat.
 */
class MicrosoftPlannerUsersPlannerTasksGetProgressTaskBoardFormat extends AbstractMicrosoftPlannerTool
{
    protected const NAME = 'microsoft_planner_users_planner_tasks_get_progress_task_board_format';
    protected const DESCRIPTION = 'Get progressTaskBoardFormat from users\n\nOfficial Microsoft Graph v1.0 endpoint: GET /users/{user-id}/planner/tasks/{plannerTask-id}/progressTaskBoardFormat.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'planner_task_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `plannerTask-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional `If-Match` ETag header. Required by many Planner PATCH and DELETE operations.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header, such as return=minimal.']];
    protected const METHOD = 'GET';
    protected const PATH = '/users/{user-id}/planner/tasks/{plannerTask-id}/progressTaskBoardFormat';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'plannerTask-id' => 'planner_task_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
