<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Managed Folders Insert.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/managedFolders.
 */
class GoogleCloudStorageManagedFoldersInsert extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_managed_folders_insert';
    protected const DESCRIPTION = 'Managed Folders Insert

Official Cloud Storage endpoint: POST /b/{bucket}/managedFolders
Creates a new managed folder.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `ManagedFolder` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/managedFolders';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
