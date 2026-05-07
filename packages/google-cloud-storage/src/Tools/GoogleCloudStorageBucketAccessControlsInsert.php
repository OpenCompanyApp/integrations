<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Bucket Access Controls Insert.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/acl.
 */
class GoogleCloudStorageBucketAccessControlsInsert extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_bucket_access_controls_insert';
    protected const DESCRIPTION = 'Bucket Access Controls Insert

Official Cloud Storage endpoint: POST /b/{bucket}/acl
Creates a new ACL entry on the specified bucket.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: userProject.',
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
    'description' => 'JSON request body matching the official Cloud Storage `BucketAccessControl` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/acl';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
