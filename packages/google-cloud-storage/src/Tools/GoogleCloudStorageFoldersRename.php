<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Folders Rename.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/folders/{sourceFolder}/renameTo/folders/{destinationFolder}.
 */
class GoogleCloudStorageFoldersRename extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_folders_rename';
    protected const DESCRIPTION = 'Folders Rename

Official Cloud Storage endpoint: POST /b/{bucket}/folders/{sourceFolder}/renameTo/folders/{destinationFolder}
Renames a source folder to a destination folder. Only applicable to buckets with hierarchical namespace enabled.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'sourceFolder' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sourceFolder`.',
  ),
  'destinationFolder' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationFolder`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: ifSourceMetagenerationMatch, ifSourceMetagenerationNotMatch.',
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
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/folders/{sourceFolder}/renameTo/folders/{destinationFolder}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'sourceFolder',
  2 => 'destinationFolder',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'ifSourceMetagenerationMatch',
  1 => 'ifSourceMetagenerationNotMatch',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
