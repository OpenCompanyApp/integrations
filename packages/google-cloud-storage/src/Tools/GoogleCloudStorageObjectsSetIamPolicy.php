<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Set Iam Policy.
 *
 * Maps to the official Cloud Storage endpoint PUT /b/{bucket}/o/{object}/iam.
 */
class GoogleCloudStorageObjectsSetIamPolicy extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_set_iam_policy';
    protected const DESCRIPTION = 'Objects Set Iam Policy

Official Cloud Storage endpoint: PUT /b/{bucket}/o/{object}/iam
Updates an IAM policy for the specified object.';
    protected const PARAMETERS = array (
  'bucket' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bucket`.',
  ),
  'object' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `object`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: generation, userProject.',
  ),
  'generation' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `generation`.',
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
    protected const PATH = '/b/{bucket}/o/{object}/iam';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
  1 => 'object',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'generation',
  1 => 'userProject',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
