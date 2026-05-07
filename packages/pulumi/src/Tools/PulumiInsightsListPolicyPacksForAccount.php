<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyPacksForAccount.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/policy/packs.
 */
class PulumiInsightsListPolicyPacksForAccount extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_list_policy_packs_for_account';
    protected const DESCRIPTION = 'ListPolicyPacksForAccount

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/policy/packs

Returns the policy packs configured to analyze resources in the specified Insights account.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'account_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accountName` from the official Pulumi Cloud API operation. The Insights account name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/policy/packs';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
