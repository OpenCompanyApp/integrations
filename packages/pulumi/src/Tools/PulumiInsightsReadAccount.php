<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadAccount.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}.
 */
class PulumiInsightsReadAccount extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_read_account';
    protected const DESCRIPTION = 'ReadAccount

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}

Gets detailed information for a specific Insights account.';
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
);
    protected const METHOD = 'get';
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
