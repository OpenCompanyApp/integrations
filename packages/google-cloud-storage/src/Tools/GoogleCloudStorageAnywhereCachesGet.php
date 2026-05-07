<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Anywhere Caches Get.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/anywhereCaches/{anywhereCacheId}.
 */
class GoogleCloudStorageAnywhereCachesGet extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_anywhere_caches_get';
    protected const DESCRIPTION = 'Anywhere Caches Get

Official Cloud Storage endpoint: GET /b/{bucket}/anywhereCaches/{anywhereCacheId}
Returns the metadata of an Anywhere Cache instance.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'anywhereCacheId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `anywhereCacheId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/anywhereCaches/{anywhereCacheId}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'anywhereCacheId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
