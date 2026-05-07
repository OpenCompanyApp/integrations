<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Managed Folders Test Iam Permissions.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/managedFolders/{managedFolder}/iam/testPermissions.
 */
class GoogleCloudStorageManagedFoldersTestIamPermissions extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_managed_folders_test_iam_permissions';
    protected const DESCRIPTION = 'Managed Folders Test Iam Permissions

Official Cloud Storage endpoint: GET /b/{bucket}/managedFolders/{managedFolder}/iam/testPermissions
Tests a set of permissions on the given managed folder to see which, if any, are held by the caller.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'managedFolder' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `managedFolder`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: permissions, userProject.',
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
    protected const PATH = '/b/{bucket}/managedFolders/{managedFolder}/iam/testPermissions';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'managedFolder',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'permissions',
  1 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
