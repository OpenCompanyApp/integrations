<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpsertResources.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts/{accountName}/resources.
 */
class PulumiInsightsUpsertResources extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_upsert_resources';
    protected const DESCRIPTION = 'UpsertResources

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts/{accountName}/resources

Creates or updates discovered resources in an Insights account. Used by scanners to report resource state.';
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
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/resources';
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
