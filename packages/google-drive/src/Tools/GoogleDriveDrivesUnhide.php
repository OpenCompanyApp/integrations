<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Drives Unhide.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/drives/{driveId}/unhide.
 */
class GoogleDriveDrivesUnhide extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_drives_unhide';
    protected const DESCRIPTION = 'Drives Unhide

Official Google Drive endpoint: POST /drive/v3/drives/{driveId}/unhide
Restores a shared drive to the default view. For more information, see [Manage shared drives](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives).';
    protected const PARAMETERS = array (
  'driveId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `driveId` from the official Google Drive API method.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/drives/{driveId}/unhide';
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
