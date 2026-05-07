<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Copy.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{sourceBucket}/o/{sourceObject}/copyTo/b/{destinationBucket}/o/{destinationObject}.
 */
class GoogleCloudStorageObjectsCopy extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_copy';
    protected const DESCRIPTION = 'Objects Copy

Official Cloud Storage endpoint: POST /b/{sourceBucket}/o/{sourceObject}/copyTo/b/{destinationBucket}/o/{destinationObject}
Copies a source object to a destination object. Optionally overrides metadata.';
    protected const PARAMETERS = array (
  'sourceBucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sourceBucket`.',
  ),
  'sourceObject' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sourceObject`.',
  ),
  'destinationBucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationBucket`.',
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: destinationKmsKeyName, destinationPredefinedAcl, ifGenerationMatch, ifGenerationNotMatch, ifMetagenerationMatch, ifMetagenerationNotMatch, ifSourceGenerationMatch, ifSourceGenerationNotMatch, ifSourceMetagenerationMatch, ifSourceMetagenerationNotMatch, projection, sourceGeneration, userProject.',
  ),
  'destinationKmsKeyName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `destinationKmsKeyName`.',
  ),
  'destinationPredefinedAcl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `destinationPredefinedAcl`.',
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
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
  ),
  'sourceGeneration' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sourceGeneration`.',
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
    'description' => 'JSON request body matching the official Cloud Storage `Object` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{sourceBucket}/o/{sourceObject}/copyTo/b/{destinationBucket}/o/{destinationObject}';
    protected const PATH_PARAMS = array (
  0 => 'sourceBucket',
  1 => 'sourceObject',
  2 => 'destinationBucket',
  3 => 'destinationObject',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'destinationKmsKeyName',
  1 => 'destinationPredefinedAcl',
  2 => 'ifGenerationMatch',
  3 => 'ifGenerationNotMatch',
  4 => 'ifMetagenerationMatch',
  5 => 'ifMetagenerationNotMatch',
  6 => 'ifSourceGenerationMatch',
  7 => 'ifSourceGenerationNotMatch',
  8 => 'ifSourceMetagenerationMatch',
  9 => 'ifSourceMetagenerationNotMatch',
  10 => 'projection',
  11 => 'sourceGeneration',
  12 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
