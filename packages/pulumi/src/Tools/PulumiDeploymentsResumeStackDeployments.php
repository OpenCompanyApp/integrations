<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ResumeStackDeployments.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/resume.
 */
class PulumiDeploymentsResumeStackDeployments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_resume_stack_deployments';
    protected const DESCRIPTION = 'ResumeStackDeployments

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/resume

Resumes Pulumi Deployments executions for a stack that was previously paused via PauseStackDeployments. Any queued deployments that accumulated while the stack was paused will begin processing. The stack must have deployment settings configured. Requires stack deployment create permissions.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/resume';
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
