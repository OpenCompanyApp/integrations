<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets Relocate.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/relocate.
 */
class GoogleCloudStorageBucketsRelocate extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_relocate';
    protected const DESCRIPTION = 'Buckets Relocate

Official Cloud Storage endpoint: POST /b/{bucket}/relocate
Initiates a long-running Relocate Bucket operation on the specified bucket.';
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
    'description' => 'JSON request body matching the official Cloud Storage `RelocateBucketRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/relocate';
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
