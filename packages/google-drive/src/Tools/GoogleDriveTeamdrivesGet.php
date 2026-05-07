<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Teamdrives Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/teamdrives/{teamDriveId}.
 */
class GoogleDriveTeamdrivesGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_teamdrives_get';
    protected const DESCRIPTION = 'Teamdrives Get

Official Google Drive endpoint: GET /drive/v3/teamdrives/{teamDriveId}
Deprecated: Use `drives.get` instead.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/teamdrives/{teamDriveId}';
    protected const PATH_PARAMS = array (
  0 => 'teamDriveId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'useDomainAdminAccess',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
