<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a Custom Base Image from an existing container project.
 *
 * Maps to the official Snyk endpoint post /custom_base_images.
 */
class SnykCreateCustomBaseImage extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_custom_base_image';
    protected const DESCRIPTION = 'Create a Custom Base Image from an existing container project

Official Snyk endpoint: POST /custom_base_images

In order to create a custom base image, you first need to import your base images into Snyk. You can do this through the CLI, UI, or API. This endpoint marks an image as a custom base image. This means that the image will get added to the pool of images from which Snyk can recommend base image upgrades. Note, after the first image in a repository gets added, a versioning schema cannot be passed in this endpoint. To update the versioning schema, the PATCH endpoint must be used.';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/custom_base_images';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
