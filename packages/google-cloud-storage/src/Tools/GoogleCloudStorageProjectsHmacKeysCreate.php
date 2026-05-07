<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Projects Hmac Keys Create.
 *
 * Maps to the official Cloud Storage endpoint POST /projects/{projectId}/hmacKeys.
 */
class GoogleCloudStorageProjectsHmacKeysCreate extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_projects_hmac_keys_create';
    protected const DESCRIPTION = 'Projects Hmac Keys Create

Official Cloud Storage endpoint: POST /projects/{projectId}/hmacKeys
Creates a new HMAC key for the specified service account.';
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
    'description' => 'Query string parameters accepted by the official Cloud Storage method. Known keys: serviceAccountEmail, userProject.',
  ),
  'serviceAccountEmail' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `serviceAccountEmail`.',
  ),
  'userProject' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProject`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{projectId}/hmacKeys';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'serviceAccountEmail',
  1 => 'userProject',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
