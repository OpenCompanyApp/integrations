<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Object Access Controls Delete.
 *
 * Maps to the official Cloud Storage endpoint DELETE /b/{bucket}/o/{object}/acl/{entity}.
 */
class GoogleCloudStorageObjectAccessControlsDelete extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_object_access_controls_delete';
    protected const DESCRIPTION = 'Object Access Controls Delete

Official Cloud Storage endpoint: DELETE /b/{bucket}/o/{object}/acl/{entity}
Permanently deletes the ACL entry for the specified entity on the specified object.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: generation, userProject.',
  ),
  'generation' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `generation`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/b/{bucket}/o/{object}/acl/{entity}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'object',
  2 => 'entity',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'generation',
  1 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
