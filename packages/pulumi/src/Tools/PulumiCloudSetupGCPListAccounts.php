<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GCPListAccounts.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/cloudsetup/{orgName}/oauth/gcp/accounts.
 */
class PulumiCloudSetupGCPListAccounts extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_cloud_setup_gcplist_accounts';
    protected const DESCRIPTION = 'GCPListAccounts

Official Pulumi Cloud endpoint: GET /api/esc/cloudsetup/{orgName}/oauth/gcp/accounts

Lists GCP projects accessible with the provided oauth session';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'oauth_session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `oauthSessionId` from the official Pulumi Cloud API operation. The OAuth session identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/cloudsetup/{orgName}/oauth/gcp/accounts';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'oauthSessionId' => 'oauth_session_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
