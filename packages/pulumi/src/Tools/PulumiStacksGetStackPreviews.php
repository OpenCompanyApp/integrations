<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackPreviews.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/previews.
 */
class PulumiStacksGetStackPreviews extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_previews';
    protected const DESCRIPTION = 'GetStackPreviews

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/previews

Returns all preview operations associated with a specific stack update version. Multiple previews may be associated with a single update version when a stack is previewed multiple times before an update is applied. Supports pagination via page and pageSize parameters and chronological sorting via the asc parameter.';
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
  'version' =>
  array (
    'type' => 'integer',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The stack update version number',
  ),
  'asc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `asc` from the official Pulumi Cloud API operation. When true, sorts results in ascending chronological order; when false or omitted, sorts in descending order',
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/previews';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'asc' => 'asc',
  'page' => 'page',
  'pageSize' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
