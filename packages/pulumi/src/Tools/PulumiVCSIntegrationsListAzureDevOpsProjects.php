<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAzureDevOpsProjects.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/azure-devops/setup/organizations/{adoOrgName}/projects.
 */
class PulumiVCSIntegrationsListAzureDevOpsProjects extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_azure_dev_ops_projects';
    protected const DESCRIPTION = 'ListAzureDevOpsProjects

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/azure-devops/setup/organizations/{adoOrgName}/projects

Lists Azure DevOps projects within a specified Azure DevOps organization that are available to the current user.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'ado_org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `adoOrgName` from the official Pulumi Cloud API operation. The Azure DevOps organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/azure-devops/setup/organizations/{adoOrgName}/projects';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'adoOrgName' => 'ado_org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
