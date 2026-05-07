<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PauseStackDeployments.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/pause.
 */
class PulumiDeploymentsPauseStackDeployments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_pause_stack_deployments';
    protected const DESCRIPTION = 'PauseStackDeployments

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/pause

Pauses all future Pulumi Deployments executions for a specific stack. While paused, new deployments can still be queued and currently executing deployments will continue to run to completion. However, queued deployments will not be picked up for execution until deployments are resumed. The stack must have deployment settings configured before it can be paused. Requires stack deployment create permissions. Use the ResumeStackDeployments endpoint to resume processing.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/pause';
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
