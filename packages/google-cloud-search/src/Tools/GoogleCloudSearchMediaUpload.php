<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Media Upload.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/media/{+resourceName}.
 */
class GoogleCloudSearchMediaUpload extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_media_upload';
    protected const DESCRIPTION = 'Media Upload

Official Google Cloud Search endpoint: POST /v1/media/{+resourceName}
Uploads media for indexing.';
    protected const PARAMETERS = array (
  'resourceName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceName`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `Media` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/media/{+resourceName}';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
