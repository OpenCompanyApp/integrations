<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetAzureDevOpsIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/azure-devops/{integrationId}.
 */
class PulumiVCSIntegrationsGetAzureDevOpsIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_azure_dev_ops_integration';
    protected const DESCRIPTION = 'GetAzureDevOpsIntegration

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/azure-devops/{integrationId}

Gets a specific Azure DevOps integration by its integration ID. Returns the integration details including organization, project, and authentication configuration.';
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
    protected const METHOD = 'get';
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
