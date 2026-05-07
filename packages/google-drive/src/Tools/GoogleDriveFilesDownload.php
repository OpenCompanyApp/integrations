<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Download.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/download.
 */
class GoogleDriveFilesDownload extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_download';
    protected const DESCRIPTION = 'Files Download

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/download
Downloads the content of a file. For more information, see [Download and export files](https://developers.google.com/workspace/drive/api/guides/manage-downloads). Operations are valid for 24 hours from the time of creation.';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: mimeType, revisionId.',
  ),
  'mimeType' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The MIME type the file should be downloaded as. This field can only be set when downloading Google Workspace documents. For a list of supported MIME types, see [Export MIME types for Google Workspace documents](/workspace/drive/api/guides/ref-export-formats). If not set, a Google Workspace document is downloaded with a default MIME type. The default MIME type might change in the future.',
  ),
  'revisionId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The revision ID of the file to download. This field can only be set when downloading blob files, Google Docs, and Google Sheets. Returns `INVALID_ARGUMENT` if downloading a specific revision on the file is unsupported.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/download';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'mimeType',
  1 => 'revisionId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
