<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Folders Insert.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/folders.
 */
class GoogleCloudStorageFoldersInsert extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_folders_insert';
    protected const DESCRIPTION = 'Folders Insert

Official Cloud Storage endpoint: POST /b/{bucket}/folders
Creates a new folder. Only applicable to buckets with hierarchical namespace enabled.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: recursive.',
  ),
  'recursive' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `recursive`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `Folder` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/folders';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'recursive',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
