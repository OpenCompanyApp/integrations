<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Create.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files.
 */
class GoogleDriveFilesCreate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_create';
    protected const DESCRIPTION = 'Files Create

Official Google Drive endpoint: POST /drive/v3/files
Creates a file. For more information, see [Create and manage files](https://developers.google.com/workspace/drive/api/guides/create-file). This method supports an */upload* URI and accepts uploaded media with the following characteristics: - *Maximum file size:* 5,120 GB - *Accepted Media MIME types:* `*/*` (Specify a valid MIME type, rather than the literal `*/*` value. The literal `*/*` is only used to indicate that any valid MIME type can be uploaded. For more information, see [Google Workspace and Google Drive supported MIME types](https://developers.google.com/workspace/drive/api/guides/mime-types).) For more information on uploading files, see [Upload file data](https://developers.google.com/workspace/drive/api/guides/manage-uploads). Apps creating shortcuts with the `create` method must specify the MIME type `application/vnd.google-apps.shortcut`. Apps should specify a file extension in the `name` property when inserting files with the API. For example, an operation to insert a JPEG file should specify something like `"name": "cat.jpg"` in the metadata. Subsequent `GET` requests include the read-only `fileExtension` property populated with the extension originally specified in the `name` property. When a Google Drive user requests to download a file, or when the file is downloaded through the sync client, Drive builds a full filename (with extension) based on the name. In cases where the extension is missing, Drive attempts to determine the extension based on the file\'s MIME type.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: includeLabels, enforceSingleParent, useContentAsIndexableText, ocrLanguage, supportsTeamDrives, ignoreDefaultVisibility, keepRevisionForever, supportsAllDrives, includePermissionsForView.',
  ),
  'includeLabels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of IDs of labels to include in the `labelInfo` part of the response.',
  ),
  'enforceSingleParent' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Creating files in multiple folders is no longer supported.',
  ),
  'useContentAsIndexableText' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to use the uploaded content as indexable text.',
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
  'ignoreDefaultVisibility' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to ignore the domain\'s default visibility settings for the created file. Domain administrators can choose to make all uploaded files visible to the domain by default; this parameter bypasses that behavior for the request. Permissions are still inherited from parent folders.',
  ),
  'keepRevisionForever' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to set the `keepForever` field in the new head revision. This is only applicable to files with binary content in Google Drive. Only 200 revisions for the file can be kept forever. If the limit is reached, try deleting pinned revisions.',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
  'includePermissionsForView' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Specifies which additional view\'s permissions to include in the response. Only `published` is supported.',
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
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includeLabels',
  1 => 'enforceSingleParent',
  2 => 'useContentAsIndexableText',
  3 => 'ocrLanguage',
  4 => 'supportsTeamDrives',
  5 => 'ignoreDefaultVisibility',
  6 => 'keepRevisionForever',
  7 => 'supportsAllDrives',
  8 => 'includePermissionsForView',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_UPLOAD_PATH = '/upload/drive/v3/files';
}
