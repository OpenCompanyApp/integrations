<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Test Iam Permissions.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/o/{object}/iam/testPermissions.
 */
class GoogleCloudStorageObjectsTestIamPermissions extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_test_iam_permissions';
    protected const DESCRIPTION = 'Objects Test Iam Permissions

Official Cloud Storage endpoint: GET /b/{bucket}/o/{object}/iam/testPermissions
Tests a set of permissions on the given object to see which, if any, are held by the caller.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: generation, permissions, userProject.',
  ),
  'generation' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `generation`.',
  ),
  'permissions' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `permissions`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/o/{object}/iam/testPermissions';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'object',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'generation',
  1 => 'permissions',
  2 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
