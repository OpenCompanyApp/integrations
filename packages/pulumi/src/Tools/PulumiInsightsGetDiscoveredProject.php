<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDiscoveredProject.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/discovered-stacks/{projectName}.
 */
class PulumiInsightsGetDiscoveredProject extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_get_discovered_project';
    protected const DESCRIPTION = 'GetDiscoveredProject

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/discovered-stacks/{projectName}

Returns details for a discovered project, including its discovered stacks. Results are paginated; use the continuationToken from the response to fetch subsequent pages.';
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
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The discovered project name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Opaque token for fetching the next page of stacks',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/discovered-stacks/{projectName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
