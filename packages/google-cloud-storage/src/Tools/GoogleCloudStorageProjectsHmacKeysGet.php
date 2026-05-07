<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Projects Hmac Keys Get.
 *
 * Maps to the official Cloud Storage endpoint GET /projects/{projectId}/hmacKeys/{accessId}.
 */
class GoogleCloudStorageProjectsHmacKeysGet extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_projects_hmac_keys_get';
    protected const DESCRIPTION = 'Projects Hmac Keys Get

Official Cloud Storage endpoint: GET /projects/{projectId}/hmacKeys/{accessId}
Retrieves an HMAC key\'s metadata';
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
    protected const METHOD = 'GET';
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
