<?php

namespace OpenCompany\Integrations\MicrosoftPlanner\Tools;

/**
 * Delete navigation property details for planner.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /planner/tasks/{plannerTask-id}/details.
 */
class MicrosoftPlannerTasksDeleteDetails extends AbstractMicrosoftPlannerTool
{
    protected const NAME = 'microsoft_planner_tasks_delete_details';
    protected const DESCRIPTION = 'Delete navigation property details for planner\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /planner/tasks/{plannerTask-id}/details.';
    protected const PARAMETERS = ['planner_task_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `plannerTask-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional `If-Match` ETag header. Required by many Planner PATCH and DELETE operations.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header, such as return=minimal.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/planner/tasks/{plannerTask-id}/details';
    protected const PATH_PARAMS = ['plannerTask-id' => 'planner_task_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
