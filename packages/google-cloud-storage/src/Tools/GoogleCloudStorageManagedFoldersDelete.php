<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Managed Folders Delete.
 *
 * Maps to the official Cloud Storage endpoint DELETE /b/{bucket}/managedFolders/{managedFolder}.
 */
class GoogleCloudStorageManagedFoldersDelete extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_managed_folders_delete';
    protected const DESCRIPTION = 'Managed Folders Delete

Official Cloud Storage endpoint: DELETE /b/{bucket}/managedFolders/{managedFolder}
Permanently deletes a managed folder.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: ifMetagenerationMatch, ifMetagenerationNotMatch, allowNonEmpty.',
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
  'allowNonEmpty' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `allowNonEmpty`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/b/{bucket}/managedFolders/{managedFolder}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'managedFolder',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'ifMetagenerationMatch',
  1 => 'ifMetagenerationNotMatch',
  2 => 'allowNonEmpty',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
