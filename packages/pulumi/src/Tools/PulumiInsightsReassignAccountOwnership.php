<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReassignStackOwnership.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts/{accountName}/ownership.
 */
class PulumiInsightsReassignAccountOwnership extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_reassign_account_ownership';
    protected const DESCRIPTION = 'ReassignStackOwnership

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts/{accountName}/ownership

Changes the ownership of the specified Insights account to the provided user. Returns the identity of the previous owner.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/ownership';
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
