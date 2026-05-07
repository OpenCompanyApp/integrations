<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a custom base image.
 *
 * Maps to the official Snyk endpoint delete /custom_base_images/{custombaseimage_id}.
 */
class SnykDeleteCustomBaseImage extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_custom_base_image';
    protected const DESCRIPTION = 'Delete a custom base image

Official Snyk endpoint: DELETE /custom_base_images/{custombaseimage_id}

Delete a custom base image resource. (the related container project is unaffected)';
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
    protected const METHOD = 'delete';
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
