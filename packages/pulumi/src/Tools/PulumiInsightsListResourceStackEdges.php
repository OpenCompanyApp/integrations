<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListResourceStackEdges.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/stack_edges.
 */
class PulumiInsightsListResourceStackEdges extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_list_resource_stack_edges';
    protected const DESCRIPTION = 'ListResourceStackEdges

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/stack_edges

Returns the Pulumi stacks that manage the specified discovered resource.';
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
    'description' => 'Path parameter `resourceTypeAndId` from the official Pulumi Cloud API operation. The resource type and cloud provider ID, double-URL-encoded, in the format \'type::id\' (e.g., \'aws:ec2/instance:Instance::i-1234567890abcd...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/stack_edges';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
  'resourceTypeAndId' => 'resource_type_and_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
