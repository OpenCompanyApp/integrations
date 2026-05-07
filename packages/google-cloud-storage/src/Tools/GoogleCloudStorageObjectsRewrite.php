<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Rewrite.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{sourceBucket}/o/{sourceObject}/rewriteTo/b/{destinationBucket}/o/{destinationObject}.
 */
class GoogleCloudStorageObjectsRewrite extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_rewrite';
    protected const DESCRIPTION = 'Objects Rewrite

Official Cloud Storage endpoint: POST /b/{sourceBucket}/o/{sourceObject}/rewriteTo/b/{destinationBucket}/o/{destinationObject}
Rewrites a source object to a destination object. Optionally overrides metadata.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: destinationKmsKeyName, destinationPredefinedAcl, dropContextGroups, ifGenerationMatch, ifGenerationNotMatch, ifMetagenerationMatch, ifMetagenerationNotMatch, ifSourceGenerationMatch, ifSourceGenerationNotMatch, ifSourceMetagenerationMatch, ifSourceMetagenerationNotMatch, maxBytesRewrittenPerCall, projection, rewriteToken, sourceGeneration, userProject.',
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
  'maxBytesRewrittenPerCall' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxBytesRewrittenPerCall`.',
  ),
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
  ),
  'rewriteToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `rewriteToken`.',
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
    protected const PATH = '/b/{sourceBucket}/o/{sourceObject}/rewriteTo/b/{destinationBucket}/o/{destinationObject}';
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
  2 => 'dropContextGroups',
  3 => 'ifGenerationMatch',
  4 => 'ifGenerationNotMatch',
  5 => 'ifMetagenerationMatch',
  6 => 'ifMetagenerationNotMatch',
  7 => 'ifSourceGenerationMatch',
  8 => 'ifSourceGenerationNotMatch',
  9 => 'ifSourceMetagenerationMatch',
  10 => 'ifSourceMetagenerationNotMatch',
  11 => 'maxBytesRewrittenPerCall',
  12 => 'projection',
  13 => 'rewriteToken',
  14 => 'sourceGeneration',
  15 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
