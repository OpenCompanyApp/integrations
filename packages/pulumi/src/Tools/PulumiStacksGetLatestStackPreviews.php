<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetLatestStackPreviews.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/updates/latest/previews.
 */
class PulumiStacksGetLatestStackPreviews extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_latest_stack_previews';
    protected const DESCRIPTION = 'GetLatestStackPreviews

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/updates/latest/previews

Returns all preview operations associated with the latest stack update version. Previews are dry-run operations that show what changes would be made. Supports pagination via page and pageSize parameters (page 0 returns all results). The asc parameter controls sort order (ascending or descending by chronological order).';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/updates/latest/previews';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
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
