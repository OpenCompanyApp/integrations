<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateStackPolicyResults.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/preview/insights/{orgName}/policy/stacks/{projectName}/{stackName}/updates/{version}/results.
 */
class PulumiInsightsUpdateStackPolicyResults extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_update_stack_policy_results';
    protected const DESCRIPTION = 'UpdateStackPolicyResults

Official Pulumi Cloud endpoint: PUT /api/preview/insights/{orgName}/policy/stacks/{projectName}/{stackName}/updates/{version}/results

Updates the policy evaluation results for a specific stack update version.';
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
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The stack update version number identifying a specific Pulumi update operation',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/preview/insights/{orgName}/policy/stacks/{projectName}/{stackName}/updates/{version}/results';
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
