<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Bucket Access Controls List.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/acl.
 */
class GoogleCloudStorageBucketAccessControlsList extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_bucket_access_controls_list';
    protected const DESCRIPTION = 'Bucket Access Controls List

Official Cloud Storage endpoint: GET /b/{bucket}/acl
Retrieves ACL entries on the specified bucket.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/acl';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
