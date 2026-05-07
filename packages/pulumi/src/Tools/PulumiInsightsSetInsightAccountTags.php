<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * SetInsightAccountTags.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/preview/insights/{orgName}/accounts/{accountName}/tags.
 */
class PulumiInsightsSetInsightAccountTags extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_set_insight_account_tags';
    protected const DESCRIPTION = 'SetInsightAccountTags

Official Pulumi Cloud endpoint: PUT /api/preview/insights/{orgName}/accounts/{accountName}/tags

Atomically replaces all tags for an Insights account with the provided key-value pairs. For AWS parent accounts, tag changes cascade to all child accounts.';
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
    protected const METHOD = 'put';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/tags';
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
