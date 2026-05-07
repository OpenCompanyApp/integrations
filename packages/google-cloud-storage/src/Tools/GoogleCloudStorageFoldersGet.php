<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Folders Get.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/folders/{folder}.
 */
class GoogleCloudStorageFoldersGet extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_folders_get';
    protected const DESCRIPTION = 'Folders Get

Official Cloud Storage endpoint: GET /b/{bucket}/folders/{folder}
Returns metadata for the specified folder. Only applicable to buckets with hierarchical namespace enabled.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'folder' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `folder`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: ifMetagenerationMatch, ifMetagenerationNotMatch.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/folders/{folder}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'folder',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'ifMetagenerationMatch',
  1 => 'ifMetagenerationNotMatch',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
