<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackPolicyPacks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/policypacks.
 */
class PulumiStacksGetStackPolicyPacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_policy_packs';
    protected const DESCRIPTION = 'GetStackPolicyPacks

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/policypacks

Returns the policy packs currently enforced on the specified stack through its policy group memberships. The optional \'mode\' query parameter filters results by enforcement mode: \'audit\' (violations are logged but allowed) or \'preventative\' (violations block the update). Returns 400 if the mode parameter is invalid.';
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
  'mode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `mode` from the official Pulumi Cloud API operation. Filter by policy group enforcement mode (\'audit\' or \'preventative\')',
    'enum' =>
    array (
      0 => 'audit',
      1 => 'preventative',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/policypacks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'mode' => 'mode',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
