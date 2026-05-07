<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateAccount.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/preview/insights/{orgName}/accounts/{accountName}.
 */
class PulumiInsightsUpdateAccount extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_update_account';
    protected const DESCRIPTION = 'UpdateAccount

Official Pulumi Cloud endpoint: PATCH /api/preview/insights/{orgName}/accounts/{accountName}

Updates an existing Insights account. Supports partial updates to the ESC environment reference, scan schedule (\'none\' or \'daily\'), and provider-specific configuration such as the list of regions to scan. All request body fields are optional; only provided fields are updated.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
