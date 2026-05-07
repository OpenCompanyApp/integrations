<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Projects Hmac Keys List.
 *
 * Maps to the official Cloud Storage endpoint GET /projects/{projectId}/hmacKeys.
 */
class GoogleCloudStorageProjectsHmacKeysList extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_projects_hmac_keys_list';
    protected const DESCRIPTION = 'Projects Hmac Keys List

Official Cloud Storage endpoint: GET /projects/{projectId}/hmacKeys
Retrieves a list of HMAC keys matching the criteria.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: maxResults, pageToken, serviceAccountEmail, showDeletedKeys, userProject.',
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
  'serviceAccountEmail' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `serviceAccountEmail`.',
  ),
  'showDeletedKeys' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `showDeletedKeys`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{projectId}/hmacKeys';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'pageToken',
  2 => 'serviceAccountEmail',
  3 => 'showDeletedKeys',
  4 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
