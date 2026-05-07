<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a custom base image.
 *
 * Maps to the official Snyk endpoint get /custom_base_images/{custombaseimage_id}.
 */
class SnykGetCustomBaseImage extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_custom_base_image';
    protected const DESCRIPTION = 'Get a custom base image

Official Snyk endpoint: GET /custom_base_images/{custombaseimage_id}

Get a custom base image';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'custombaseimage_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `custombaseimage_id` from the official Snyk API operation. Unique identifier for custom base image',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/custom_base_images/{custombaseimage_id}';
    protected const PATH_PARAMS = array (
  'custombaseimage_id' => 'custombaseimage_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
