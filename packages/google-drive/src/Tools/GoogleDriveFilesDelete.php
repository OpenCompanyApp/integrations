<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Delete.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/files/{fileId}.
 */
class GoogleDriveFilesDelete extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_delete';
    protected const DESCRIPTION = 'Files Delete

Official Google Drive endpoint: DELETE /drive/v3/files/{fileId}
Permanently deletes a file owned by the user without moving it to the trash. For more information, see [Trash or delete files and folders](https://developers.google.com/workspace/drive/api/guides/delete). If the file belongs to a shared drive, the user must be an `organizer` on the parent folder. If the target is a folder, all descendants owned by the user are also deleted.';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: supportsTeamDrives, enforceSingleParent, supportsAllDrives.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
  'enforceSingleParent' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: If an item isn\'t in a shared drive and its last parent is deleted but the item itself isn\'t, the item will be placed under its owner\'s root.',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/files/{fileId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'supportsTeamDrives',
  1 => 'enforceSingleParent',
  2 => 'supportsAllDrives',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
