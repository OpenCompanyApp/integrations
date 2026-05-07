<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadResource.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/versions/{resourceVersion}.
 */
class PulumiInsightsReadResourceVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_read_resource_versions';
    protected const DESCRIPTION = 'ReadResource

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/versions/{resourceVersion}

Returns a discovered resource with its current or specified version details.';
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
  'resource_version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceVersion` from the official Pulumi Cloud API operation. The specific version number of the discovered resource to retrieve',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/versions/{resourceVersion}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
  'resourceTypeAndId' => 'resource_type_and_id',
  'resourceVersion' => 'resource_version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
