<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Projects Service Account Get.
 *
 * Maps to the official Cloud Storage endpoint GET /projects/{projectId}/serviceAccount.
 */
class GoogleCloudStorageProjectsServiceAccountGet extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_projects_service_account_get';
    protected const DESCRIPTION = 'Projects Service Account Get

Official Cloud Storage endpoint: GET /projects/{projectId}/serviceAccount
Get the email address of this project\'s Google Cloud Storage service account.';
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
    protected const PATH = '/projects/{projectId}/serviceAccount';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
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
