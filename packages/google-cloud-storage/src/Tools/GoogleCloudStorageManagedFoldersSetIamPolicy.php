<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Managed Folders Set Iam Policy.
 *
 * Maps to the official Cloud Storage endpoint PUT /b/{bucket}/managedFolders/{managedFolder}/iam.
 */
class GoogleCloudStorageManagedFoldersSetIamPolicy extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_managed_folders_set_iam_policy';
    protected const DESCRIPTION = 'Managed Folders Set Iam Policy

Official Cloud Storage endpoint: PUT /b/{bucket}/managedFolders/{managedFolder}/iam
Updates an IAM policy for the specified managed folder.';
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
    'description' => 'JSON request body matching the official Cloud Storage `Policy` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/b/{bucket}/managedFolders/{managedFolder}/iam';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'managedFolder',
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
