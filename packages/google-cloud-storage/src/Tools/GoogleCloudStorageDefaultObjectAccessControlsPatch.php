<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Default Object Access Controls Patch.
 *
 * Maps to the official Cloud Storage endpoint PATCH /b/{bucket}/defaultObjectAcl/{entity}.
 */
class GoogleCloudStorageDefaultObjectAccessControlsPatch extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_default_object_access_controls_patch';
    protected const DESCRIPTION = 'Default Object Access Controls Patch

Official Cloud Storage endpoint: PATCH /b/{bucket}/defaultObjectAcl/{entity}
Patches a default object ACL entry on the specified bucket.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'entity' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entity`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: userProject.',
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
    'description' => 'JSON request body matching the official Cloud Storage `ObjectAccessControl` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/b/{bucket}/defaultObjectAcl/{entity}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'entity',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
