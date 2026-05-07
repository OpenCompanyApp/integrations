<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateAzureDevOpsIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/console/orgs/{orgName}/integrations/azure-devops/{integrationId}.
 */
class PulumiVCSIntegrationsUpdateAzureDevOpsIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_update_azure_dev_ops_integration';
    protected const DESCRIPTION = 'UpdateAzureDevOpsIntegration

Official Pulumi Cloud endpoint: PATCH /api/console/orgs/{orgName}/integrations/azure-devops/{integrationId}

Updates an existing Azure DevOps integration\'s settings. Can modify the Azure DevOps organization, project, or authentication configuration.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The Azure DevOps integration identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/azure-devops/{integrationId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'integrationId' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
