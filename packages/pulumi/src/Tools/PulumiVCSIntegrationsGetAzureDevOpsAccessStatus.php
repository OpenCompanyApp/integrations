<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetAzureDevOpsAccessStatus.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/azure-devops/access-status.
 */
class PulumiVCSIntegrationsGetAzureDevOpsAccessStatus extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_azure_dev_ops_access_status';
    protected const DESCRIPTION = 'GetAzureDevOpsAccessStatus

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/azure-devops/access-status

Returns information about a user\'s Azure DevOps access status for an organization, including whether the user has a valid OAuth token.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/azure-devops/access-status';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
