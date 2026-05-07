<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Permissions List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/permissions.
 */
class GoogleDrivePermissionsList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_permissions_list';
    protected const DESCRIPTION = 'Permissions List

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/permissions
Lists a file\'s or shared drive\'s permissions. For more information, see [Share files, folders, and drives](https://developers.google.com/workspace/drive/api/guides/manage-sharing).';
    protected const PARAMETERS = array (
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: supportsTeamDrives, pageToken, pageSize, includePermissionsForView, supportsAllDrives, useDomainAdminAccess.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The token for continuing a previous list request on the next page. This should be set to the value of `nextPageToken` from the previous response.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of permissions to return per page. When not set for files in a shared drive, at most 100 results will be returned. When not set for files that are not in a shared drive, the entire list will be returned.',
  ),
  'includePermissionsForView' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Specifies which additional view\'s permissions to include in the response. Only `published` is supported.',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
  'useDomainAdminAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Issue the request as a domain administrator. If set to `true`, and if the following additional conditions are met, the requester is granted access: 1. The file ID parameter refers to a shared drive. 2. The requester is an administrator of the domain to which the shared drive belongs. For more information, see [Manage shared drives as domain administrators](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives#manage-administrators).',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/permissions';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'supportsTeamDrives',
  1 => 'pageToken',
  2 => 'pageSize',
  3 => 'includePermissionsForView',
  4 => 'supportsAllDrives',
  5 => 'useDomainAdminAccess',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
