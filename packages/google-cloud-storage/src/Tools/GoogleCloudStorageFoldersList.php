<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Folders List.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/folders.
 */
class GoogleCloudStorageFoldersList extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_folders_list';
    protected const DESCRIPTION = 'Folders List

Official Cloud Storage endpoint: GET /b/{bucket}/folders
Retrieves a list of folders matching the criteria. Only applicable to buckets with hierarchical namespace enabled.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: delimiter, endOffset, pageSize, pageToken, prefix, startOffset.',
  ),
  'delimiter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `delimiter`.',
  ),
  'endOffset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `endOffset`.',
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
  'startOffset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `startOffset`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/folders';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'delimiter',
  1 => 'endOffset',
  2 => 'pageSize',
  3 => 'pageToken',
  4 => 'prefix',
  5 => 'startOffset',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
