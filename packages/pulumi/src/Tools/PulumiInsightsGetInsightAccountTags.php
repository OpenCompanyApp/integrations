<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetInsightAccountTags.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/tags.
 */
class PulumiInsightsGetInsightAccountTags extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_get_insight_account_tags';
    protected const DESCRIPTION = 'GetInsightAccountTags

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/tags

Returns all tags for an Insights account as a key-value map.';
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
