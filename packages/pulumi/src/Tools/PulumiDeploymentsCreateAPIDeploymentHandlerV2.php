<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateAPIDeploymentHandlerV2.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments.
 */
class PulumiDeploymentsCreateAPIDeploymentHandlerV2 extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_create_apideployment_handler_v2';
    protected const DESCRIPTION = 'CreateAPIDeploymentHandlerV2

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments

Initiates a new Pulumi Deployments execution for a stack. Pulumi Deployments is a managed service that executes Pulumi operations (update, preview, refresh, or destroy) in a secure, hosted environment. **Important:** The stack must already exist before a deployment can be created for it. The `operation` field is required and accepts: `update`, `preview`, `refresh`, or `destroy`. Three usage modes are supported: 1. **Stack settings only:** Send `{"operation": "update"}` to use the stack\'s saved deployment settings. 2. **Merged settings:** Include partial settings in the request body alongside `operation`. When `inheritSettings` is true (the default), request settings are merged with saved stack settings, with request values taking precedence. 3. **Request settings only:** Set `inheritSettings` to false and provide all settings in the request body. Settings include source context (git r...';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments';
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
