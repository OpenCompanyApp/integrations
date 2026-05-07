<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Objects List.
 *
 * Maps to the official Cloud Storage endpoint GET /b/{bucket}/o.
 */
class GoogleCloudStorageObjectsList extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_objects_list';
    protected const DESCRIPTION = 'Objects List

Official Cloud Storage endpoint: GET /b/{bucket}/o
Retrieves a list of objects matching the criteria.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: delimiter, endOffset, includeTrailingDelimiter, maxResults, pageToken, prefix, projection, startOffset, userProject, versions, matchGlob, filter, softDeleted, includeFoldersAsPrefixes.',
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
  'matchGlob' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `matchGlob`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'softDeleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `softDeleted`.',
  ),
  'includeFoldersAsPrefixes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `includeFoldersAsPrefixes`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b/{bucket}/o';
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
  10 => 'matchGlob',
  11 => 'filter',
  12 => 'softDeleted',
  13 => 'includeFoldersAsPrefixes',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
