<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Apps Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/apps/{appId}.
 */
class GoogleDriveAppsGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_apps_get';
    protected const DESCRIPTION = 'Apps Get

Official Google Drive endpoint: GET /drive/v3/apps/{appId}
Gets a specific app. For more information, see [Return user info](https://developers.google.com/workspace/drive/api/guides/user-info).';
    protected const PARAMETERS = array (
  'appId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `appId` from the official Google Drive API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/apps/{appId}';
    protected const PATH_PARAMS = array (
  0 => 'appId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
