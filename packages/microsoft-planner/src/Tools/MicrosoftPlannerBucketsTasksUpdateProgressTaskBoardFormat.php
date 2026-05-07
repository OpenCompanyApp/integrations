<?php

namespace OpenCompany\Integrations\MicrosoftPlanner\Tools;

/**
 * Update the navigation property progressTaskBoardFormat in planner.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /planner/buckets/{plannerBucket-id}/tasks/{plannerTask-id}/progressTaskBoardFormat.
 */
class MicrosoftPlannerBucketsTasksUpdateProgressTaskBoardFormat extends AbstractMicrosoftPlannerTool
{
    protected const NAME = 'microsoft_planner_buckets_tasks_update_progress_task_board_format';
    protected const DESCRIPTION = 'Update the navigation property progressTaskBoardFormat in planner\n\nOfficial Microsoft Graph v1.0 endpoint: PATCH /planner/buckets/{plannerBucket-id}/tasks/{plannerTask-id}/progressTaskBoardFormat.';
    protected const PARAMETERS = ['planner_bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `plannerBucket-id`.'], 'planner_task_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `plannerTask-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional `If-Match` ETag header. Required by many Planner PATCH and DELETE operations.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header, such as return=minimal.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Planner OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/planner/buckets/{plannerBucket-id}/tasks/{plannerTask-id}/progressTaskBoardFormat';
    protected const PATH_PARAMS = ['plannerBucket-id' => 'planner_bucket_id', 'plannerTask-id' => 'planner_task_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
