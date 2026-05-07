<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets Patch.
 *
 * Maps to the official Cloud Storage endpoint PATCH /b/{bucket}.
 */
class GoogleCloudStorageBucketsPatch extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_patch';
    protected const DESCRIPTION = 'Buckets Patch

Official Cloud Storage endpoint: PATCH /b/{bucket}
Patches a bucket. Changes to the bucket will be readable immediately after writing, but configuration changes may take time to propagate.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: ifMetagenerationMatch, ifMetagenerationNotMatch, predefinedAcl, predefinedDefaultObjectAcl, projection, userProject.',
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
  'predefinedAcl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `predefinedAcl`.',
  ),
  'predefinedDefaultObjectAcl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `predefinedDefaultObjectAcl`.',
  ),
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `Bucket` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/b/{bucket}';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'ifMetagenerationMatch',
  1 => 'ifMetagenerationNotMatch',
  2 => 'predefinedAcl',
  3 => 'predefinedDefaultObjectAcl',
  4 => 'projection',
  5 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
