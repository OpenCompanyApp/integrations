<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteAzureDevOpsIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/console/orgs/{orgName}/integrations/azure-devops/{integrationId}.
 */
class PulumiVCSIntegrationsDeleteAzureDevOpsIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_delete_azure_dev_ops_integration';
    protected const DESCRIPTION = 'DeleteAzureDevOpsIntegration

Official Pulumi Cloud endpoint: DELETE /api/console/orgs/{orgName}/integrations/azure-devops/{integrationId}

Removes a specific Azure DevOps integration from the organization.';
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
);
    protected const METHOD = 'delete';
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
