<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateResourceVersionPolicyResults.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/versions/{resourceVersion}/policy/results.
 */
class PulumiInsightsUpdateResourceVersionPolicyResults extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_update_resource_version_policy_results';
    protected const DESCRIPTION = 'UpdateResourceVersionPolicyResults

Official Pulumi Cloud endpoint: PUT /api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/versions/{resourceVersion}/policy/results

Updates the policy evaluation results for a specific version of a discovered resource.';
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
    'description' => 'Path parameter `resourceVersion` from the official Pulumi Cloud API operation. The specific version number of the discovered resource to update policy results for',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/resources/{resourceTypeAndId}/versions/{resourceVersion}/policy/results';
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
