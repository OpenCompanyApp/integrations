<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Drives Hide.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/drives/{driveId}/hide.
 */
class GoogleDriveDrivesHide extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_drives_hide';
    protected const DESCRIPTION = 'Drives Hide

Official Google Drive endpoint: POST /drive/v3/drives/{driveId}/hide
Hides a shared drive from the default view. For more information, see [Manage shared drives](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives).';
    protected const PARAMETERS = array (
  'driveId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `driveId` from the official Google Drive API method.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/drives/{driveId}/hide';
    protected const PATH_PARAMS = array (
  0 => 'driveId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
