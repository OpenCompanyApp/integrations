<?php

namespace OpenCompany\Integrations\MicrosoftPlanner\Tools;

/**
 * Get planner from me.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /me/planner.
 */
class MicrosoftPlannerMeGetPlanner extends AbstractMicrosoftPlannerTool
{
    protected const NAME = 'microsoft_planner_me_get_planner';
    protected const DESCRIPTION = 'Get planner from me\n\nOfficial Microsoft Graph v1.0 endpoint: GET /me/planner.';
    protected const PARAMETERS = ['top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional `If-Match` ETag header. Required by many Planner PATCH and DELETE operations.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header, such as return=minimal.']];
    protected const METHOD = 'GET';
    protected const PATH = '/me/planner';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
