<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}.
 */
class GoogleDriveFilesGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_get';
    protected const DESCRIPTION = 'Files Get

Official Google Drive endpoint: GET /drive/v3/files/{fileId}
Gets a file\'s metadata or content by ID. For more information, see [Search for files and folders](https://developers.google.com/workspace/drive/api/guides/search-files). If you provide the URL parameter `alt=media`, then the response includes the file contents in the response body. Downloading content with `alt=media` only works if the file is stored in Drive. To download Google Docs, Sheets, and Slides use [`files.export`](https://developers.google.com/workspace/drive/api/reference/rest/v3/files/export) instead. For more information, see [Download and export files](https://developers.google.com/workspace/drive/api/guides/manage-downloads).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: includePermissionsForView, supportsAllDrives, acknowledgeAbuse, supportsTeamDrives, includeLabels.',
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
  'acknowledgeAbuse' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the user is acknowledging the risk of downloading known malware or other abusive files. This is only applicable when the `alt` parameter is set to `media` and the user is the owner of the file or an organizer of the shared drive in which the file resides.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
  'includeLabels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of IDs of labels to include in the `labelInfo` part of the response.',
  ),
  'alt' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Use `media` for raw file/revision content where the Drive method supports media download.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includePermissionsForView',
  1 => 'supportsAllDrives',
  2 => 'acknowledgeAbuse',
  3 => 'supportsTeamDrives',
  4 => 'includeLabels',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
