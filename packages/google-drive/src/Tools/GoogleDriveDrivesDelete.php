<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Drives Delete.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/drives/{driveId}.
 */
class GoogleDriveDrivesDelete extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_drives_delete';
    protected const DESCRIPTION = 'Drives Delete

Official Google Drive endpoint: DELETE /drive/v3/drives/{driveId}
Permanently deletes a shared drive for which the user is an `organizer`. The shared drive cannot contain any untrashed items. For more information, see [Manage shared drives](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: allowItemDeletion, useDomainAdminAccess.',
  ),
  'allowItemDeletion' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether any items inside the shared drive should also be deleted. This option is only supported when `useDomainAdminAccess` is also set to `true`.',
  ),
  'useDomainAdminAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Issue the request as a domain administrator; if set to true, then the requester will be granted access if they are an administrator of the domain to which the shared drive belongs.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/drives/{driveId}';
    protected const PATH_PARAMS = array (
  0 => 'driveId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'allowItemDeletion',
  1 => 'useDomainAdminAccess',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
