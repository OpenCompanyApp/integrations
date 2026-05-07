<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Empty Trash.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/files/trash.
 */
class GoogleDriveFilesEmptyTrash extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_empty_trash';
    protected const DESCRIPTION = 'Files Empty Trash

Official Google Drive endpoint: DELETE /drive/v3/files/trash
Permanently deletes all of the user\'s trashed files. For more information, see [Trash or delete files and folders](https://developers.google.com/workspace/drive/api/guides/delete).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: enforceSingleParent, driveId.',
  ),
  'enforceSingleParent' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: If an item isn\'t in a shared drive and its last parent is deleted but the item itself isn\'t, the item will be placed under its owner\'s root.',
  ),
  'driveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'If set, empties the trash of the provided shared drive.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/files/trash';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'enforceSingleParent',
  1 => 'driveId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
