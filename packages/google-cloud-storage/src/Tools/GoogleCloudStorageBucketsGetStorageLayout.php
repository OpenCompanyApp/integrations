<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets Get Storage Layout.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/storageLayout.
 */
class GoogleCloudStorageBucketsGetStorageLayout extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_get_storage_layout';
    protected const DESCRIPTION = 'Buckets Get Storage Layout

Official Cloud Storage endpoint: GET /b/{bucket}/storageLayout
Returns the storage layout configuration for the specified bucket. Note that this operation requires storage.objects.list permission.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: prefix.',
  ),
  'prefix' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `prefix`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/storageLayout';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'prefix',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
