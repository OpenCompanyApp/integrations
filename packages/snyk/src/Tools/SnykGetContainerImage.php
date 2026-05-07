<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get instance of container image.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/container_images/{image_id}.
 */
class SnykGetContainerImage extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_container_image';
    protected const DESCRIPTION = 'Get instance of container image

Official Snyk endpoint: GET /orgs/{org_id}/container_images/{image_id}

Get instance of container image #### Required permissions - `View container images (org.container_image.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/container_images/{image_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'image_id' => 'image_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
