<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets Set Iam Policy.
 *
 * Maps to the official Cloud Storage endpoint PUT /b/{bucket}/iam.
 */
class GoogleCloudStorageBucketsSetIamPolicy extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_set_iam_policy';
    protected const DESCRIPTION = 'Buckets Set Iam Policy

Official Cloud Storage endpoint: PUT /b/{bucket}/iam
Updates an IAM policy for the specified bucket.';
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
    'description' => 'JSON request body matching the official Cloud Storage `Policy` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/b/{bucket}/iam';
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
