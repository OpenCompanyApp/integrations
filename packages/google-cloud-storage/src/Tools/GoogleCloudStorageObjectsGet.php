<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Get.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/o/{object}.
 */
class GoogleCloudStorageObjectsGet extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_get';
    protected const DESCRIPTION = 'Objects Get

Official Cloud Storage endpoint: GET /b/{bucket}/o/{object}
Retrieves an object or its metadata.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'object' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `object`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: generation, ifGenerationMatch, ifGenerationNotMatch, ifMetagenerationMatch, ifMetagenerationNotMatch, projection, userProject, softDeleted, restoreToken.',
  ),
  'generation' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `generation`.',
  ),
  'ifGenerationMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifGenerationMatch`.',
  ),
  'ifGenerationNotMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifGenerationNotMatch`.',
  ),
  'ifMetagenerationMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifMetagenerationMatch`.',
  ),
  'ifMetagenerationNotMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifMetagenerationNotMatch`.',
  ),
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
  'softDeleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `softDeleted`.',
  ),
  'restoreToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `restoreToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/o/{object}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'object',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'generation',
  1 => 'ifGenerationMatch',
  2 => 'ifGenerationNotMatch',
  3 => 'ifMetagenerationMatch',
  4 => 'ifMetagenerationNotMatch',
  5 => 'projection',
  6 => 'userProject',
  7 => 'softDeleted',
  8 => 'restoreToken',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = true;
    protected const UPLOAD_PATH = '';
}
