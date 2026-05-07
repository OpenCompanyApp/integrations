<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List instances of image target references for a container image.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/container_images/{image_id}/relationships/image_target_refs.
 */
class SnykListImageTargetRefs extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_image_target_refs';
    protected const DESCRIPTION = 'List instances of image target references for a container image

Official Snyk endpoint: GET /orgs/{org_id}/container_images/{image_id}/relationships/image_target_refs

List instances of image target references for a container image #### Required permissions - `View container images (org.container_image.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'image_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `image_id` from the official Snyk API operation. Image ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/container_images/{image_id}/relationships/image_target_refs';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'image_id' => 'image_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
