<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Permissions Delete.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/files/{fileId}/permissions/{permissionId}.
 */
class GoogleDrivePermissionsDelete extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_permissions_delete';
    protected const DESCRIPTION = 'Permissions Delete

Official Google Drive endpoint: DELETE /drive/v3/files/{fileId}/permissions/{permissionId}
Deletes a permission. For more information, see [Share files, folders, and drives](https://developers.google.com/workspace/drive/api/guides/manage-sharing). **Warning:** Concurrent permissions operations on the same file aren\'t supported; only the last update is applied.';
    protected const PARAMETERS = array (
  'permissionId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `permissionId` from the official Google Drive API method.',
  ),
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: useDomainAdminAccess, supportsAllDrives, enforceExpansiveAccess, supportsTeamDrives.',
  ),
  'useDomainAdminAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Issue the request as a domain administrator. If set to `true`, and if the following additional conditions are met, the requester is granted access: 1. The file ID parameter refers to a shared drive. 2. The requester is an administrator of the domain to which the shared drive belongs. For more information, see [Manage shared drives as domain administrators](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives#manage-administrators).',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
  'enforceExpansiveAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: All requests use the expansive access rules.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/files/{fileId}/permissions/{permissionId}';
    protected const PATH_PARAMS = array (
  0 => 'permissionId',
  1 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'useDomainAdminAccess',
  1 => 'supportsAllDrives',
  2 => 'enforceExpansiveAccess',
  3 => 'supportsTeamDrives',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
