<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * StackDeploymentsMetadata.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/metadata.
 */
class PulumiDeploymentsStackDeploymentsMetadata extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_stack_deployments_metadata';
    protected const DESCRIPTION = 'StackDeploymentsMetadata

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/metadata

Returns metadata about the Pulumi Deployments state for a specific stack. The response distinguishes the source of any pause: - `paused`: overall pause status (true if either stack or org is paused) - `stackPaused`: whether the stack itself is paused - `organizationPaused`: whether the containing organization is paused This is useful for determining whether new deployments will be processed or held in the queue.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/metadata';
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
