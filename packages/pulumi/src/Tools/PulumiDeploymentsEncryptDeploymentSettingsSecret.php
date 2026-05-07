<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * EncryptDeploymentSettingsSecret.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings/encrypt.
 */
class PulumiDeploymentsEncryptDeploymentSettingsSecret extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_encrypt_deployment_settings_secret';
    protected const DESCRIPTION = 'EncryptDeploymentSettingsSecret

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings/encrypt

Encrypts a plaintext secret value for secure storage in Pulumi Deployments settings. Use this endpoint to encrypt sensitive values such as cloud provider credentials, API keys, or other secrets before including them in deployment settings (e.g. as environment variables in operationContext). The encrypted value can then be safely stored in the deployment settings and will be decrypted at deployment execution time. The request body must contain a non-empty plaintext value to encrypt.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings/encrypt';
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
