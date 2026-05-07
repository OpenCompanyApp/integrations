<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Permissions Create.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/permissions.
 */
class GoogleDrivePermissionsCreate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_permissions_create';
    protected const DESCRIPTION = 'Permissions Create

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/permissions
Creates a permission for a file or shared drive. For more information, see [Share files, folders, and drives](https://developers.google.com/workspace/drive/api/guides/manage-sharing). **Warning:** Concurrent permissions operations on the same file aren\'t supported; only the last update is applied.';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: enforceExpansiveAccess, transferOwnership, enforceSingleParent, emailMessage, useDomainAdminAccess, supportsTeamDrives, moveToNewOwnersRoot, supportsAllDrives, sendNotificationEmail.',
  ),
  'enforceExpansiveAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: All requests use the expansive access rules.',
  ),
  'transferOwnership' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to transfer ownership to the specified user and downgrade the current owner to a writer. This parameter is required as an acknowledgement of the side effect. For more information, see [Transfer file ownership](https://developers.google.com/workspace/drive/api/guides/transfer-file).',
  ),
  'enforceSingleParent' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: See `moveToNewOwnersRoot` for details.',
  ),
  'emailMessage' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A plain text custom message to include in the notification email.',
  ),
  'useDomainAdminAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Issue the request as a domain administrator. If set to `true`, and if the following additional conditions are met, the requester is granted access: 1. The file ID parameter refers to a shared drive. 2. The requester is an administrator of the domain to which the shared drive belongs. For more information, see [Manage shared drives as domain administrators](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives#manage-administrators).',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
  'moveToNewOwnersRoot' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'This parameter only takes effect if the item isn\'t in a shared drive and the request is attempting to transfer the ownership of the item. If set to `true`, the item is moved to the new owner\'s My Drive root folder and all prior parents removed. If set to `false`, parents aren\'t changed.',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
  'sendNotificationEmail' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to send a notification email when sharing to users or groups. This defaults to `true` for users and groups, and is not allowed for other requests. It must not be disabled for ownership transfers.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Permission` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/permissions';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'enforceExpansiveAccess',
  1 => 'transferOwnership',
  2 => 'enforceSingleParent',
  3 => 'emailMessage',
  4 => 'useDomainAdminAccess',
  5 => 'supportsTeamDrives',
  6 => 'moveToNewOwnersRoot',
  7 => 'supportsAllDrives',
  8 => 'sendNotificationEmail',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
