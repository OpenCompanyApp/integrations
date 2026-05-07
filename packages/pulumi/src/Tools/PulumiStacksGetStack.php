<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStack.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}.
 */
class PulumiStacksGetStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack';
    protected const DESCRIPTION = 'GetStack

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}

Retrieves detailed information about a specific stack, including its organization, project, and stack name, the current version number, all associated tags, any active update operations (with the operation kind, author, and start time), and the active update UUID. This is the primary endpoint for inspecting the current state and metadata of a stack.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}';
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
