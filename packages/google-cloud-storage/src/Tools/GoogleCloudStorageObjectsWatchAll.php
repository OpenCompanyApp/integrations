<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects Watch All.
 *
 * Maps to the official Cloud Storage endpoint POST /b/{bucket}/o/watch.
 */
class GoogleCloudStorageObjectsWatchAll extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_watch_all';
    protected const DESCRIPTION = 'Objects Watch All

Official Cloud Storage endpoint: POST /b/{bucket}/o/watch
Watch for changes on all objects in a bucket.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: delimiter, endOffset, includeTrailingDelimiter, maxResults, pageToken, prefix, projection, startOffset, userProject, versions.',
  ),
  'delimiter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `delimiter`.',
  ),
  'endOffset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `endOffset`.',
  ),
  'includeTrailingDelimiter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `includeTrailingDelimiter`.',
  ),
  'maxResults' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'prefix' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `prefix`.',
  ),
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
  ),
  'startOffset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `startOffset`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
  'versions' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `versions`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/b/{bucket}/o/watch';
    protected const PATH_PARAMS = array (
  0 => 'bucket',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'delimiter',
  1 => 'endOffset',
  2 => 'includeTrailingDelimiter',
  3 => 'maxResults',
  4 => 'pageToken',
  5 => 'prefix',
  6 => 'projection',
  7 => 'startOffset',
  8 => 'userProject',
  9 => 'versions',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
