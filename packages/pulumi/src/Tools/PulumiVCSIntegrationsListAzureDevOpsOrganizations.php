<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAzureDevOpsOrganizations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/azure-devops/setup/organizations.
 */
class PulumiVCSIntegrationsListAzureDevOpsOrganizations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_azure_dev_ops_organizations';
    protected const DESCRIPTION = 'ListAzureDevOpsOrganizations

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/azure-devops/setup/organizations

Lists Azure DevOps organizations available to the current user. Requires an active Azure DevOps OAuth token.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/azure-devops/setup/organizations';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
