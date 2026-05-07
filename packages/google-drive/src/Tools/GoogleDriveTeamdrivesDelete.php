<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Teamdrives Delete.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/teamdrives/{teamDriveId}.
 */
class GoogleDriveTeamdrivesDelete extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_teamdrives_delete';
    protected const DESCRIPTION = 'Teamdrives Delete

Official Google Drive endpoint: DELETE /drive/v3/teamdrives/{teamDriveId}
Deprecated: Use `drives.delete` instead.';
    protected const PARAMETERS = array (
  'teamDriveId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamDriveId` from the official Google Drive API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/teamdrives/{teamDriveId}';
    protected const PATH_PARAMS = array (
  0 => 'teamDriveId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
