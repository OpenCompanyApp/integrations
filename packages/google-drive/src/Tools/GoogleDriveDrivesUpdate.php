<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Drives Update.
 *
 * Maps to the official Google Drive endpoint PATCH /drive/v3/drives/{driveId}.
 */
class GoogleDriveDrivesUpdate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_drives_update';
    protected const DESCRIPTION = 'Drives Update

Official Google Drive endpoint: PATCH /drive/v3/drives/{driveId}
Updates the metadata for a shared drive. For more information, see [Manage shared drives](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives).';
    protected const PARAMETERS = array (
  'driveId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `driveId` from the official Google Drive API method.',
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
    'description' => 'Issue the request as a domain administrator; if set to true, then the requester will be granted access if they are an administrator of the domain to which the shared drive belongs.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Drive` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/drive/v3/drives/{driveId}';
    protected const PATH_PARAMS = array (
  0 => 'driveId',
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
