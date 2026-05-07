<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets Get Iam Policy.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/iam.
 */
class GoogleCloudStorageBucketsGetIamPolicy extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_get_iam_policy';
    protected const DESCRIPTION = 'Buckets Get Iam Policy

Official Cloud Storage endpoint: GET /b/{bucket}/iam
Returns an IAM policy for the specified bucket.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: optionsRequestedPolicyVersion, userProject.',
  ),
  'optionsRequestedPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `optionsRequestedPolicyVersion`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/iam';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'optionsRequestedPolicyVersion',
  1 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
