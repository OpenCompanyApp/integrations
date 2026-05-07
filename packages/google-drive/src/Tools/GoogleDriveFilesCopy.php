<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Copy.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/copy.
 */
class GoogleDriveFilesCopy extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_copy';
    protected const DESCRIPTION = 'Files Copy

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/copy
Creates a copy of a file and applies any requested updates with patch semantics. For more information, see [Create and manage files](https://developers.google.com/workspace/drive/api/guides/create-file).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: includePermissionsForView, supportsAllDrives, keepRevisionForever, ignoreDefaultVisibility, ocrLanguage, supportsTeamDrives, enforceSingleParent, includeLabels.',
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
  'keepRevisionForever' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to set the `keepForever` field in the new head revision. This is only applicable to files with binary content in Google Drive. Only 200 revisions for the file can be kept forever. If the limit is reached, try deleting pinned revisions.',
  ),
  'ignoreDefaultVisibility' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to ignore the domain\'s default visibility settings for the created file. Domain administrators can choose to make all uploaded files visible to the domain by default; this parameter bypasses that behavior for the request. Permissions are still inherited from parent folders.',
  ),
  'ocrLanguage' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A language hint for OCR processing during image import (ISO 639-1 code).',
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
    'description' => 'Deprecated: Copying files into multiple folders is no longer supported. Use shortcuts instead.',
  ),
  'includeLabels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of IDs of labels to include in the `labelInfo` part of the response.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `File` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/copy';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includePermissionsForView',
  1 => 'supportsAllDrives',
  2 => 'keepRevisionForever',
  3 => 'ignoreDefaultVisibility',
  4 => 'ocrLanguage',
  5 => 'supportsTeamDrives',
  6 => 'enforceSingleParent',
  7 => 'includeLabels',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
