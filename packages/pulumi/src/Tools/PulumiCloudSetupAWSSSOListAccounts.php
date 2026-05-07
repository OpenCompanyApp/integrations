<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AWSSSOListAccounts.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/cloudsetup/{orgName}/aws/sso/accounts.
 */
class PulumiCloudSetupAWSSSOListAccounts extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_cloud_setup_awsssolist_accounts';
    protected const DESCRIPTION = 'AWSSSOListAccounts

Official Pulumi Cloud endpoint: GET /api/esc/cloudsetup/{orgName}/aws/sso/accounts

Lists AWS accounts accessible with the provided session';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `region` from the official Pulumi Cloud API operation. The AWS region',
  ),
  'session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sessionId` from the official Pulumi Cloud API operation. The SSO session identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/cloudsetup/{orgName}/aws/sso/accounts';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'region' => 'region',
  'sessionId' => 'session_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
