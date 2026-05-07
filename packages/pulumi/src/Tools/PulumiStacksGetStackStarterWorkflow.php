<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackStarterWorkflow.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/workflow.
 */
class PulumiStacksGetStackStarterWorkflow extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_starter_workflow';
    protected const DESCRIPTION = 'GetStackStarterWorkflow

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/workflow

Generates a customized CI/CD workflow template for the specified stack. The request body must specify the target CI system (e.g. GitHub Actions, GitLab CI). The generated template is tailored to the stack\'s runtime and configuration. Returns 400 if the CI system is not specified or the stack does not have a runtime tag. Returns 404 if no matching workflow template is found.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/workflow';
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
