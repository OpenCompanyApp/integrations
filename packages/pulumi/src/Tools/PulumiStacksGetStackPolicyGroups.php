<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackPolicyGroups.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/policygroups.
 */
class PulumiStacksGetStackPolicyGroups extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_policy_groups';
    protected const DESCRIPTION = 'GetStackPolicyGroups

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/policygroups

Returns the list of policy groups that include the specified stack. Policy groups define which policy packs are enforced on a set of stacks. The response includes each group\'s name, the stacks it applies to, and the policy packs configured within it.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/policygroups';
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
