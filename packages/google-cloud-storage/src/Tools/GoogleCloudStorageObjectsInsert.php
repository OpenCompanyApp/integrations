<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Insert.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/o.
 */
class GoogleCloudStorageObjectsInsert extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_insert';
    protected const DESCRIPTION = 'Objects Insert

Official Cloud Storage endpoint: POST /b/{bucket}/o
Stores a new object and metadata.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: contentEncoding, ifGenerationMatch, ifGenerationNotMatch, ifMetagenerationMatch, ifMetagenerationNotMatch, kmsKeyName, name, predefinedAcl, projection, userProject.',
  ),
  'contentEncoding' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `contentEncoding`.',
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
  'kmsKeyName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `kmsKeyName`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name`.',
  ),
  'predefinedAcl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `predefinedAcl`.',
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON metadata or upload payload. For media upload, pass `file_path` or `content`; optional `content_type` defaults to application/octet-stream.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/o';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'contentEncoding',
  1 => 'ifGenerationMatch',
  2 => 'ifGenerationNotMatch',
  3 => 'ifMetagenerationMatch',
  4 => 'ifMetagenerationNotMatch',
  5 => 'kmsKeyName',
  6 => 'name',
  7 => 'predefinedAcl',
  8 => 'projection',
  9 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '/upload/storage/v1/b/{bucket}/o';
}
