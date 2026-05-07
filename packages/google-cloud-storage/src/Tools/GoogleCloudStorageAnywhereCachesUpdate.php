<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Anywhere Caches Update.
 *
 * Maps to the official Cloud Storage endpoint PATCH /b/{bucket}/anywhereCaches/{anywhereCacheId}.
 */
class GoogleCloudStorageAnywhereCachesUpdate extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_anywhere_caches_update';
    protected const DESCRIPTION = 'Anywhere Caches Update

Official Cloud Storage endpoint: PATCH /b/{bucket}/anywhereCaches/{anywhereCacheId}
Updates the config of an Anywhere Cache instance.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `AnywhereCache` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/b/{bucket}/anywhereCaches/{anywhereCacheId}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'anywhereCacheId',
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
