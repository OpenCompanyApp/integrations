<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets Lock Retention Policy.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/lockRetentionPolicy.
 */
class GoogleCloudStorageBucketsLockRetentionPolicy extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_lock_retention_policy';
    protected const DESCRIPTION = 'Buckets Lock Retention Policy

Official Cloud Storage endpoint: POST /b/{bucket}/lockRetentionPolicy
Locks retention policy on a bucket.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: ifMetagenerationMatch, userProject.',
  ),
  'ifMetagenerationMatch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ifMetagenerationMatch`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/lockRetentionPolicy';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'ifMetagenerationMatch',
  1 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
