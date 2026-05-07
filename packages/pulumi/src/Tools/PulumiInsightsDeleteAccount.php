<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteAccount.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/preview/insights/{orgName}/accounts/{accountName}.
 */
class PulumiInsightsDeleteAccount extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_delete_account';
    protected const DESCRIPTION = 'DeleteAccount

Official Pulumi Cloud endpoint: DELETE /api/preview/insights/{orgName}/accounts/{accountName}

Deletes an Insights account and its associated configuration. This operation is irreversible.';
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
    protected const METHOD = 'delete';
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
