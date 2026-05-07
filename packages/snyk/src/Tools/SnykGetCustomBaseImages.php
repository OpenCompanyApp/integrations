<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a custom base image collection.
 *
 * Maps to the official Snyk endpoint get /custom_base_images.
 */
class SnykGetCustomBaseImages extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_custom_base_images';
    protected const DESCRIPTION = 'Get a custom base image collection

Official Snyk endpoint: GET /custom_base_images

Get a list of custom base images with support for ordering and filtering. Either the org_id or group_id parameters must be set to authorize successfully. If sorting by version, the repository filter is required.';
    protected const PARAMETERS = array (
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
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `project_id` from the official Snyk API operation. The ID of the container project that the custom base image is based off of.',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `org_id` from the official Snyk API operation. The organization ID of the custom base image',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `group_id` from the official Snyk API operation. The group ID of the custom base image',
  ),
  'repository' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `repository` from the official Snyk API operation. The image repository',
  ),
  'tag' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `tag` from the official Snyk API operation. The image tag',
  ),
  'include_in_recommendations' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_in_recommendations` from the official Snyk API operation. Whether this image should be recommended as a base image upgrade',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort_by` from the official Snyk API operation. Which column to sort by. If sorting by version, the versioning schema is used.',
    'enum' =>
    array (
      0 => 'repository',
      1 => 'tag',
      2 => 'version',
    ),
  ),
  'sort_direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort_direction` from the official Snyk API operation. Which direction to sort',
    'enum' =>
    array (
      0 => 'ASC',
      1 => 'DESC',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/custom_base_images';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'project_id' => 'project_id',
  'org_id' => 'org_id',
  'group_id' => 'group_id',
  'repository' => 'repository',
  'tag' => 'tag',
  'include_in_recommendations' => 'include_in_recommendations',
  'sort_by' => 'sort_by',
  'sort_direction' => 'sort_direction',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
