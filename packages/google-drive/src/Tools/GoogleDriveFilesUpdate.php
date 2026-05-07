<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Update.
 *
 * Maps to the official Google Drive endpoint PATCH /drive/v3/files/{fileId}.
 */
class GoogleDriveFilesUpdate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_update';
    protected const DESCRIPTION = 'Files Update

Official Google Drive endpoint: PATCH /drive/v3/files/{fileId}
Updates a file\'s metadata, content, or both. When calling this method, only populate fields in the request that you want to modify. When updating fields, some fields might be changed automatically, such as `modifiedDate`. This method supports patch semantics. This method supports an */upload* URI and accepts uploaded media with the following characteristics: - *Maximum file size:* 5,120 GB - *Accepted Media MIME types:* `*/*` (Specify a valid MIME type, rather than the literal `*/*` value. The literal `*/*` is only used to indicate that any valid MIME type can be uploaded. For more information, see [Google Workspace and Google Drive supported MIME types](https://developers.google.com/workspace/drive/api/guides/mime-types).) For more information on uploading files, see [Upload file data](https://developers.google.com/workspace/drive/api/guides/manage-uploads).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: includePermissionsForView, supportsAllDrives, ocrLanguage, supportsTeamDrives, keepRevisionForever, removeParents, addParents, enforceSingleParent, useContentAsIndexableText, includeLabels.',
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
  'keepRevisionForever' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to set the `keepForever` field in the new head revision. This is only applicable to files with binary content in Google Drive. Only 200 revisions for the file can be kept forever. If the limit is reached, try deleting pinned revisions.',
  ),
  'removeParents' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of parent IDs to remove.',
  ),
  'addParents' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of parent IDs to add.',
  ),
  'enforceSingleParent' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Adding files to multiple folders is no longer supported. Use shortcuts instead.',
  ),
  'useContentAsIndexableText' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to use the uploaded content as indexable text.',
  ),
  'includeLabels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of IDs of labels to include in the `labelInfo` part of the response.',
  ),
  'file_path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Local file path to upload to Google Drive for this media endpoint.',
  ),
  'mime_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'MIME type for the uploaded file. Defaults to application/octet-stream.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Optional Drive file metadata body for multipart uploads.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/drive/v3/files/{fileId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includePermissionsForView',
  1 => 'supportsAllDrives',
  2 => 'ocrLanguage',
  3 => 'supportsTeamDrives',
  4 => 'keepRevisionForever',
  5 => 'removeParents',
  6 => 'addParents',
  7 => 'enforceSingleParent',
  8 => 'useContentAsIndexableText',
  9 => 'includeLabels',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_UPLOAD_PATH = '/upload/drive/v3/files/{fileId}';
}
