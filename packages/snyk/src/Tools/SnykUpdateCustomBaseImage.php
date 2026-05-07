<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update a custom base image.
 *
 * Maps to the official Snyk endpoint patch /custom_base_images/{custombaseimage_id}.
 */
class SnykUpdateCustomBaseImage extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_custom_base_image';
    protected const DESCRIPTION = 'Update a custom base image

Official Snyk endpoint: PATCH /custom_base_images/{custombaseimage_id}

Updates a custom base image\'s attributes';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
