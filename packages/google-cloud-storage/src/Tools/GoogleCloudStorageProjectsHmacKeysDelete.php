<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Projects Hmac Keys Delete.
 *
 * Maps to the official Cloud Storage endpoint DELETE /projects/{projectId}/hmacKeys/{accessId}.
 */
class GoogleCloudStorageProjectsHmacKeysDelete extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_projects_hmac_keys_delete';
    protected const DESCRIPTION = 'Projects Hmac Keys Delete

Official Cloud Storage endpoint: DELETE /projects/{projectId}/hmacKeys/{accessId}
Deletes an HMAC key.';
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
);
    protected const METHOD = 'DELETE';
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
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
