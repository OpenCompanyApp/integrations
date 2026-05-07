<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAccounts.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts.
 */
class PulumiInsightsListAccounts extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_list_accounts';
    protected const DESCRIPTION = 'ListAccounts

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts

Lists Insights accounts available to the authenticated user within the specified organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Number of results to return (default: 100, max: 1000)',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent` from the official Pulumi Cloud API operation. Filter results to child accounts of the specified parent account name (e.g., an AWS organization management account)',
  ),
  'role_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `roleID` from the official Pulumi Cloud API operation. Filter results to accounts accessible by the specified role',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'count' => 'count',
  'parent' => 'parent',
  'roleID' => 'role_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
