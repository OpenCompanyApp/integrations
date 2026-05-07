<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackUpdates.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/updates.
 */
class PulumiStacksGetStackUpdates extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_updates';
    protected const DESCRIPTION = 'GetStackUpdates

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/updates

Returns the update history for a stack. Each update includes its kind (update, preview, refresh, destroy, import), start and end times, result status, resource changes summary, and resource count. Supports pagination via \'page\' and \'pageSize\' query parameters (page 0 returns all results, pageSize=1 with page=1 returns only the most recent update). The \'output-type\' parameter controls the response format: when unset, returns a legacy format; when set, returns a paginated response.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'output_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `output-type` from the official Pulumi Cloud API operation. Controls the response format; when unset returns the legacy format, otherwise returns the paginated format',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page` from the official Pulumi Cloud API operation. Page number for paginated results (0-indexed, where 0 returns all results)',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `pageSize` from the official Pulumi Cloud API operation. Number of results per page (must be >= 1 when page > 0)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/updates';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'output-type' => 'output_type',
  'page' => 'page',
  'pageSize' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
