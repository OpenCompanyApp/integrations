<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets Insert.
 *
 * Maps to the official Cloud Storage endpoint POST /b.
 */
class GoogleCloudStorageBucketsInsert extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_insert';
    protected const DESCRIPTION = 'Buckets Insert

Official Cloud Storage endpoint: POST /b
Creates a new bucket.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: predefinedAcl, predefinedDefaultObjectAcl, project, projection, userProject, enableObjectRetention.',
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
  'project' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `project`.',
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
  'enableObjectRetention' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `enableObjectRetention`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `Bucket` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'predefinedAcl',
  1 => 'predefinedDefaultObjectAcl',
  2 => 'project',
  3 => 'projection',
  4 => 'userProject',
  5 => 'enableObjectRetention',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
