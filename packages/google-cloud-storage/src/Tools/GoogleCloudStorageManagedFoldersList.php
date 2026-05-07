<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Managed Folders List.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/managedFolders.
 */
class GoogleCloudStorageManagedFoldersList extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_managed_folders_list';
    protected const DESCRIPTION = 'Managed Folders List

Official Cloud Storage endpoint: GET /b/{bucket}/managedFolders
Lists managed folders in the given bucket.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: pageSize, pageToken, prefix.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'prefix' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `prefix`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/managedFolders';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'prefix',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
