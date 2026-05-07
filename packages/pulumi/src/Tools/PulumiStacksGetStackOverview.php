<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackOverview.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/stacks/{orgName}/{projectName}/{stackName}/overview.
 */
class PulumiStacksGetStackOverview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_overview';
    protected const DESCRIPTION = 'GetStackOverview

Official Pulumi Cloud endpoint: GET /api/console/stacks/{orgName}/{projectName}/{stackName}/overview

Returns aggregated stack overview data optimized for display in the Pulumi Cloud web console. The response combines information from multiple sources including the stack\'s current state, recent activity, resource counts, and configuration into a single response to minimize round trips.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/stacks/{orgName}/{projectName}/{stackName}/overview';
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
