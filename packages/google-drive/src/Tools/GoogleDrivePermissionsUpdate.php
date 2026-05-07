<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Permissions Update.
 *
 * Maps to the official Google Drive endpoint PATCH /drive/v3/files/{fileId}/permissions/{permissionId}.
 */
class GoogleDrivePermissionsUpdate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_permissions_update';
    protected const DESCRIPTION = 'Permissions Update

Official Google Drive endpoint: PATCH /drive/v3/files/{fileId}/permissions/{permissionId}
Updates a permission with patch semantics. For more information, see [Share files, folders, and drives](https://developers.google.com/workspace/drive/api/guides/manage-sharing). **Warning:** Concurrent permissions operations on the same file aren\'t supported; only the last update is applied.';
    protected const PARAMETERS = array (
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'permissionId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `permissionId` from the official Google Drive API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: removeExpiration, enforceExpansiveAccess, supportsTeamDrives, transferOwnership, supportsAllDrives, useDomainAdminAccess.',
  ),
  'removeExpiration' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to remove the expiration date.',
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
  'transferOwnership' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to transfer ownership to the specified user and downgrade the current owner to a writer. This parameter is required as an acknowledgement of the side effect. For more information, see [Transfer file ownership](https://developers.google.com//workspace/drive/api/guides/transfer-file).',
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Permission` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/drive/v3/files/{fileId}/permissions/{permissionId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'permissionId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'removeExpiration',
  1 => 'enforceExpansiveAccess',
  2 => 'supportsTeamDrives',
  3 => 'transferOwnership',
  4 => 'supportsAllDrives',
  5 => 'useDomainAdminAccess',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
