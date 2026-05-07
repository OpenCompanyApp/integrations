<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * BulkCreateAccounts.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts.
 */
class PulumiInsightsBulkCreateAccounts extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_bulk_create_accounts';
    protected const DESCRIPTION = 'BulkCreateAccounts

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts

Creates multiple Insights accounts in a single operation. Each account is created independently, so a failure to create one account does not prevent other accounts from being created. Returns the list of successfully created accounts and details about any failures. Accounts are created with the same permissions as the single CreateAccount endpoint. For AWS accounts, regional child accounts are created automatically based on the provider configuration.';
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
    protected const PATH = '/api/preview/insights/{orgName}/accounts';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
