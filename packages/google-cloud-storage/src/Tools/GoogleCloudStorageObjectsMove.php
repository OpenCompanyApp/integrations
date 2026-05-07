<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Move.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/o/{sourceObject}/moveTo/o/{destinationObject}.
 */
class GoogleCloudStorageObjectsMove extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_move';
    protected const DESCRIPTION = 'Objects Move

Official Cloud Storage endpoint: POST /b/{bucket}/o/{sourceObject}/moveTo/o/{destinationObject}
Moves the source object to the destination object in the same bucket.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'sourceObject' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sourceObject`.',
  ),
  'destinationObject' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationObject`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: ifSourceGenerationMatch, ifSourceGenerationNotMatch, ifSourceMetagenerationMatch, ifSourceMetagenerationNotMatch, ifGenerationMatch, ifGenerationNotMatch, ifMetagenerationMatch, ifMetagenerationNotMatch, projection, userProject.',
  ),
  'ifSourceGenerationMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifSourceGenerationMatch`.',
  ),
  'ifSourceGenerationNotMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifSourceGenerationNotMatch`.',
  ),
  'ifSourceMetagenerationMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifSourceMetagenerationMatch`.',
  ),
  'ifSourceMetagenerationNotMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifSourceMetagenerationNotMatch`.',
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
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/o/{sourceObject}/moveTo/o/{destinationObject}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'sourceObject',
  2 => 'destinationObject',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'ifSourceGenerationMatch',
  1 => 'ifSourceGenerationNotMatch',
  2 => 'ifSourceMetagenerationMatch',
  3 => 'ifSourceMetagenerationNotMatch',
  4 => 'ifGenerationMatch',
  5 => 'ifGenerationNotMatch',
  6 => 'ifMetagenerationMatch',
  7 => 'ifMetagenerationNotMatch',
  8 => 'projection',
  9 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
