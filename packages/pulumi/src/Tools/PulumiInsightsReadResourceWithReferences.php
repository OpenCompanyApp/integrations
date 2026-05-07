<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadResourceWithReferences.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/references.
 */
class PulumiInsightsReadResourceWithReferences extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_read_resource_with_references';
    protected const DESCRIPTION = 'ReadResourceWithReferences

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/references

Returns a discovered resource along with its referenced (related) resources.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/references';
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
