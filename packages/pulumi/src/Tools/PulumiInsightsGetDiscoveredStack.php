<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDiscoveredStack.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}.
 */
class PulumiInsightsGetDiscoveredStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_get_discovered_stack';
    protected const DESCRIPTION = 'GetDiscoveredStack

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}

Returns details for a single discovered stack.';
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
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The discovered stack name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
