<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListResourceVersionEdges.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/edges.
 */
class PulumiInsightsListResourceVersionEdges extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_list_resource_version_edges';
    protected const DESCRIPTION = 'ListResourceVersionEdges

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/edges

Returns the relationships (edges) between a discovered resource and other resources in the account.';
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
  'resource_type_and_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceTypeAndId` from the official Pulumi Cloud API operation. The resource type and cloud provider ID, double-URL-encoded, in the format \'type::id\'',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Number of results to return (default: 100, max: 500)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/edges';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
  'resourceTypeAndId' => 'resource_type_and_id',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'count' => 'count',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
