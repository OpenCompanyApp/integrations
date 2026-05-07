<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Projects Hmac Keys Update.
 *
 * Maps to the official Cloud Storage endpoint PUT /projects/{projectId}/hmacKeys/{accessId}.
 */
class GoogleCloudStorageProjectsHmacKeysUpdate extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_projects_hmac_keys_update';
    protected const DESCRIPTION = 'Projects Hmac Keys Update

Official Cloud Storage endpoint: PUT /projects/{projectId}/hmacKeys/{accessId}
Updates the state of an HMAC key. See the [HMAC Key resource descriptor](https://cloud.google.com/storage/docs/json_api/v1/projects/hmacKeys/update#request-body) for valid states.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'accessId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accessId`.',
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
    'description' => 'JSON request body matching the official Cloud Storage `HmacKeyMetadata` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/projects/{projectId}/hmacKeys/{accessId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'accessId',
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
