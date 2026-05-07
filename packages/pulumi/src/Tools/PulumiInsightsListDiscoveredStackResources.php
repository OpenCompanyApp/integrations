<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListDiscoveredStackResources.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/resources.
 */
class PulumiInsightsListDiscoveredStackResources extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_list_discovered_stack_resources';
    protected const DESCRIPTION = 'ListDiscoveredStackResources

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/resources

Returns the list of resources in a discovered stack, each annotated with a migrationStatus. When compareTo is provided, resource identities are matched against the target Pulumi stack.';
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
  'compare_to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `compareTo` from the official Pulumi Cloud API operation. Pulumi stack to compare against in project/stack format. Must be in the same org.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/resources';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'compareTo' => 'compare_to',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
