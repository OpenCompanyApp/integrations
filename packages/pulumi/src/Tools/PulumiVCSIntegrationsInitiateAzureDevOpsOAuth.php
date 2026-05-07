<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * InitiateAzureDevOpsOAuth.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/integrations/azure-devops/oauth/initiate.
 */
class PulumiVCSIntegrationsInitiateAzureDevOpsOAuth extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_initiate_azure_dev_ops_oauth';
    protected const DESCRIPTION = 'InitiateAzureDevOpsOAuth

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/integrations/azure-devops/oauth/initiate

Initiates the OAuth authorization flow for Azure DevOps VCS integration. Returns a redirect URL that the user should be directed to for authorization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/azure-devops/oauth/initiate';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
