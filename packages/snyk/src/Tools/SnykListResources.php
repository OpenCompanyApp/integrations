<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List Resources (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/cloud/resources.
 */
class SnykListResources extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_resources';
    protected const DESCRIPTION = 'List Resources (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/cloud/resources

List resources for an organization #### Required permissions - `View resources (org.cloud_resources.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Organization ID',
  ),
  'environment_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `environment_id` from the official Snyk API operation. Filter resources by environment ID (multi-value, comma-separated)',
  ),
  'resource_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `resource_type` from the official Snyk API operation. Filter resources by resource type (multi-value, comma-separated)',
  ),
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `resource_id` from the official Snyk API operation. Filter resources by resource ID (multi-value, comma-separated)',
  ),
  'native_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `native_id` from the official Snyk API operation. Filter resources by native ID (multi-value, comma-separated) (AWS ARN)',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `id` from the official Snyk API operation. Filter resources by resource UUID (multi-value, comma-separated)',
  ),
  'platform' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `platform` from the official Snyk API operation. Filter resources by platform (multi-value, comma-separated): aws',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Snyk API operation. Filter resources by name (multi-value, comma-separated)',
  ),
  'kind' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `kind` from the official Snyk API operation. Filter resources by kind (multi-value, comma-separated): cloud',
  ),
  'location' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `location` from the official Snyk API operation. Filter resources by location (multi-value, comma-separated) (AWS region)',
  ),
  'removed' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `removed` from the official Snyk API operation. Filter resources by whether they have been removed or not.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/cloud/resources';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'environment_id' => 'environment_id',
  'resource_type' => 'resource_type',
  'resource_id' => 'resource_id',
  'native_id' => 'native_id',
  'id' => 'id',
  'platform' => 'platform',
  'name' => 'name',
  'kind' => 'kind',
  'location' => 'location',
  'removed' => 'removed',
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
