<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Operations Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/operations/{name}.
 */
class GoogleDriveOperationsGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_operations_get';
    protected const DESCRIPTION = 'Operations Get

Official Google Drive endpoint: GET /drive/v3/operations/{name}
Gets the latest state of a long-running operation. Clients can use this method to poll the operation result at intervals as recommended by the API service.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Google Drive API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/operations/{name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
