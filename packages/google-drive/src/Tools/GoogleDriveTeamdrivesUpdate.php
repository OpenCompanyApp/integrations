<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Teamdrives Update.
 *
 * Maps to the official Google Drive endpoint PATCH /drive/v3/teamdrives/{teamDriveId}.
 */
class GoogleDriveTeamdrivesUpdate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_teamdrives_update';
    protected const DESCRIPTION = 'Teamdrives Update

Official Google Drive endpoint: PATCH /drive/v3/teamdrives/{teamDriveId}
Deprecated: Use `drives.update` instead.';
    protected const PARAMETERS = array (
  'teamDriveId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamDriveId` from the official Google Drive API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: useDomainAdminAccess.',
  ),
  'useDomainAdminAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Issue the request as a domain administrator; if set to true, then the requester will be granted access if they are an administrator of the domain to which the Team Drive belongs.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `TeamDrive` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/drive/v3/teamdrives/{teamDriveId}';
    protected const PATH_PARAMS = array (
  0 => 'teamDriveId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'useDomainAdminAccess',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
