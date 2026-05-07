<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListResourcesWithReferences.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts/{accountName}/resources/references.
 */
class PulumiInsightsListResourcesWithReferences extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_list_resources_with_references';
    protected const DESCRIPTION = 'ListResourcesWithReferences

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts/{accountName}/resources/references

Returns discovered resources along with their referenced resources for a batch of resource identifiers.';
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
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/resources/references';
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
