<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Compose.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{destinationBucket}/o/{destinationObject}/compose.
 */
class GoogleCloudStorageObjectsCompose extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_compose';
    protected const DESCRIPTION = 'Objects Compose

Official Cloud Storage endpoint: POST /b/{destinationBucket}/o/{destinationObject}/compose
Concatenates a list of existing objects into a new object in the same bucket.';
    protected const PARAMETERS = array (
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: destinationPredefinedAcl, dropContextGroups, ifGenerationMatch, ifMetagenerationMatch, kmsKeyName, userProject.',
  ),
  'destinationPredefinedAcl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `destinationPredefinedAcl`.',
  ),
  'dropContextGroups' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dropContextGroups`.',
  ),
  'ifGenerationMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifGenerationMatch`.',
  ),
  'ifMetagenerationMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifMetagenerationMatch`.',
  ),
  'kmsKeyName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `kmsKeyName`.',
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
    'description' => 'JSON request body matching the official Cloud Storage `ComposeRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{destinationBucket}/o/{destinationObject}/compose';
    protected const PATH_PARAMS = array (
  0 => 'destinationBucket',
  1 => 'destinationObject',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'destinationPredefinedAcl',
  1 => 'dropContextGroups',
  2 => 'ifGenerationMatch',
  3 => 'ifMetagenerationMatch',
  4 => 'kmsKeyName',
  5 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
