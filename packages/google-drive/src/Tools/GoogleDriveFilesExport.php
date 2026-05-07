<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Export.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/export.
 */
class GoogleDriveFilesExport extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_export';
    protected const DESCRIPTION = 'Files Export

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/export
Exports a Google Workspace document to the requested MIME type and returns exported byte content. For more information, see [Download and export files](https://developers.google.com/workspace/drive/api/guides/manage-downloads). Note that the exported content is limited to 10 MB.';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: mimeType.',
  ),
  'mimeType' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Required. The MIME type of the format requested for this export. For a list of supported MIME types, see [Export MIME types for Google Workspace documents](/workspace/drive/api/guides/ref-export-formats).',
  ),
  'alt' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Use `media` for raw file/revision content where the Drive method supports media download.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/export';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'mimeType',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
