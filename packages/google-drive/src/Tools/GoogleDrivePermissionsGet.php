<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Permissions Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/permissions/{permissionId}.
 */
class GoogleDrivePermissionsGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_permissions_get';
    protected const DESCRIPTION = 'Permissions Get

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/permissions/{permissionId}
Gets a permission by ID. For more information, see [Share files, folders, and drives](https://developers.google.com/workspace/drive/api/guides/manage-sharing).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: supportsTeamDrives, useDomainAdminAccess, supportsAllDrives.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/permissions/{permissionId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'permissionId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'supportsTeamDrives',
  1 => 'useDomainAdminAccess',
  2 => 'supportsAllDrives',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
