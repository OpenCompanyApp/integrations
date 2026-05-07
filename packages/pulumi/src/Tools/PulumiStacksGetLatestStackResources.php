<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetLatestStackResources.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/resources/latest.
 */
class PulumiStacksGetLatestStackResources extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_latest_stack_resources';
    protected const DESCRIPTION = 'GetLatestStackResources

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/resources/latest

Retrieves all resources currently managed by the stack from the most recent update. Each resource in the response includes its type, URN, provider, inputs, outputs, parent, and dependencies. This is equivalent to calling GetStackResources with the latest version number.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/resources/latest';
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
