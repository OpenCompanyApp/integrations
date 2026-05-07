<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Changes Get Start Page Token.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/changes/startPageToken.
 */
class GoogleDriveChangesGetStartPageToken extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_changes_get_start_page_token';
    protected const DESCRIPTION = 'Changes Get Start Page Token

Official Google Drive endpoint: GET /drive/v3/changes/startPageToken
Gets the starting pageToken for listing future changes. For more information, see [Retrieve changes](https://developers.google.com/workspace/drive/api/guides/manage-changes).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: supportsTeamDrives, supportsAllDrives, teamDriveId, driveId.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
  'teamDriveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Deprecated: Use `driveId` instead.',
  ),
  'driveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The ID of the shared drive for which the starting pageToken for listing future changes from that shared drive will be returned.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/changes/startPageToken';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'supportsTeamDrives',
  1 => 'supportsAllDrives',
  2 => 'teamDriveId',
  3 => 'driveId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
