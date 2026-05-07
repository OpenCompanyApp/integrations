<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Delete.
 *
 * Maps to the official Cloud Storage endpoint DELETE /b/{bucket}/o/{object}.
 */
class GoogleCloudStorageObjectsDelete extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_delete';
    protected const DESCRIPTION = 'Objects Delete

Official Cloud Storage endpoint: DELETE /b/{bucket}/o/{object}
Deletes an object and its metadata. Deletions are permanent if versioning is not enabled for the bucket, or if the generation parameter is used.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: generation, ifGenerationMatch, ifGenerationNotMatch, ifMetagenerationMatch, ifMetagenerationNotMatch, userProject.',
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
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'DELETE';
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
  5 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
