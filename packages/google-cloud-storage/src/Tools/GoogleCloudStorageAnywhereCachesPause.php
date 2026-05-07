<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Anywhere Caches Pause.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/pause.
 */
class GoogleCloudStorageAnywhereCachesPause extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_anywhere_caches_pause';
    protected const DESCRIPTION = 'Anywhere Caches Pause

Official Cloud Storage endpoint: POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/pause
Pauses an Anywhere Cache instance.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/anywhereCaches/{anywhereCacheId}/pause';
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
