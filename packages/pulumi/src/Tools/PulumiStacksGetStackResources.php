<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackResources.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/resources/{version}.
 */
class PulumiStacksGetStackResources extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_resources';
    protected const DESCRIPTION = 'GetStackResources

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/resources/{version}

Retrieves all resources as they existed at a specific historical stack update version. Each resource includes its type, URN, provider, inputs, outputs, parent, and dependencies. Returns 404 if the specified version does not exist for this stack.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/resources/{version}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
