<?php

namespace OpenCompany\Integrations\MicrosoftPlanner\Tools;

/**
 * Get the number of the resource.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /planner/buckets/{plannerBucket-id}/tasks/$count.
 */
class MicrosoftPlannerBucketsTasksGetCount145a extends AbstractMicrosoftPlannerTool
{
    protected const NAME = 'microsoft_planner_buckets_tasks_get_count_145a';
    protected const DESCRIPTION = 'Get the number of the resource\n\nOfficial Microsoft Graph v1.0 endpoint: GET /planner/buckets/{plannerBucket-id}/tasks/$count.';
    protected const PARAMETERS = ['planner_bucket_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `plannerBucket-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional `If-Match` ETag header. Required by many Planner PATCH and DELETE operations.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header, such as return=minimal.']];
    protected const METHOD = 'GET';
    protected const PATH = '/planner/buckets/{plannerBucket-id}/tasks/$count';
    protected const PATH_PARAMS = ['plannerBucket-id' => 'planner_bucket_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
