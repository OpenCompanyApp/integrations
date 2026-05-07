<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Drives Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/drives/{driveId}.
 */
class GoogleDriveDrivesGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_drives_get';
    protected const DESCRIPTION = 'Drives Get

Official Google Drive endpoint: GET /drive/v3/drives/{driveId}
Gets a shared drive\'s metadata by ID. For more information, see [Manage shared drives](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives).';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/drives/{driveId}';
    protected const PATH_PARAMS = array (
  0 => 'driveId',
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
