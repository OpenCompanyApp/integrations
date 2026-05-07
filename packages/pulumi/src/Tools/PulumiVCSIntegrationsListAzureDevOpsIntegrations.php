<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAzureDevOpsIntegrations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/azure-devops.
 */
class PulumiVCSIntegrationsListAzureDevOpsIntegrations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_azure_dev_ops_integrations';
    protected const DESCRIPTION = 'ListAzureDevOpsIntegrations

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/azure-devops

Lists all Azure DevOps integrations configured for an organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/azure-devops';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
