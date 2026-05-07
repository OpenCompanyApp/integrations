<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AzureListAccounts.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/cloudsetup/{orgName}/oauth/azure/accounts.
 */
class PulumiCloudSetupAzureListAccounts extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_cloud_setup_azure_list_accounts';
    protected const DESCRIPTION = 'AzureListAccounts

Official Pulumi Cloud endpoint: GET /api/esc/cloudsetup/{orgName}/oauth/azure/accounts

Lists Azure subscriptions accessible with the provided ARM session';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'arm_session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `armSessionId` from the official Pulumi Cloud API operation. The Azure ARM session identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/cloudsetup/{orgName}/oauth/azure/accounts';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'armSessionId' => 'arm_session_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
