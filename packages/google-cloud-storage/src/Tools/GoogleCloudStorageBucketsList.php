<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Buckets List.
 *
 * Maps to the official Cloud Storage endpoint GET /b.
 */
class GoogleCloudStorageBucketsList extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_buckets_list';
    protected const DESCRIPTION = 'Buckets List

Official Cloud Storage endpoint: GET /b
Retrieves a list of buckets for a given project.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: maxResults, pageToken, prefix, softDeleted, project, projection, userProject, returnPartialSuccess.',
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
  'softDeleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `softDeleted`.',
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
  'returnPartialSuccess' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `returnPartialSuccess`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/b';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'pageToken',
  2 => 'prefix',
  3 => 'softDeleted',
  4 => 'project',
  5 => 'projection',
  6 => 'userProject',
  7 => 'returnPartialSuccess',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
