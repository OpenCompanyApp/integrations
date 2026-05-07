<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackActivity.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/activity.
 */
class PulumiStacksGetStackActivity extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_activity';
    protected const DESCRIPTION = 'GetStackActivity

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/activity

Returns the activity history for a stack, including updates, configuration changes, and other operations. Supports pagination via page and pageSize parameters (page 0 returns all results). Returns 400 if the page parameter is invalid.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/activity';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'pageSize' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
