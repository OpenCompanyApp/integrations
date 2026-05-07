<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files.
 */
class GoogleDriveFilesList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_list';
    protected const DESCRIPTION = 'Files List

Official Google Drive endpoint: GET /drive/v3/files
Lists the user\'s files. For more information, see [Search for files and folders](https://developers.google.com/workspace/drive/api/guides/search-files). This method accepts the `q` parameter, which is a search query combining one or more search terms. This method returns *all* files by default, including trashed files. If you don\'t want trashed files to appear in the list, use the `trashed=false` query parameter to remove trashed files from the results.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: supportsTeamDrives, driveId, pageSize, corpus, includeTeamDriveItems, spaces, includeLabels, corpora, q, supportsAllDrives, includeItemsFromAllDrives, includePermissionsForView, pageToken, teamDriveId, orderBy.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
  'driveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'ID of the shared drive to search.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of files to return per page. Pages may be partial or empty even before reaching the end of the file list. If unspecified, at most 100 files are returned for shared drives, and the entire list of files for non-shared drives. The maximum value is 100; values above 100 are changed to 100.',
  ),
  'corpus' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Deprecated: The source of files to list. Use `corpora` instead.',
    'enum' =>
    array (
      0 => 'domain',
      1 => 'user',
    ),
  ),
  'includeTeamDriveItems' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `includeItemsFromAllDrives` instead.',
  ),
  'spaces' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of spaces to query within the corpora. Supported values are `drive` and `appDataFolder`. For more information, see [File organization](https://developers.google.com/workspace/drive/api/guides/about-files#file-organization).',
  ),
  'includeLabels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of IDs of labels to include in the `labelInfo` part of the response.',
  ),
  'corpora' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Specifies a collection of items (files or documents) to which the query applies. Supported items include: * `user` * `domain` * `drive` * `allDrives` Prefer `user` or `drive` to `allDrives` for efficiency. By default, corpora is set to `user`. However, this can change depending on the filter set through the `q` parameter. For more information, see [File organization](https://developers.google.com/workspace/drive/api/guides/about-files#file-organization).',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A query for filtering the file results. For supported syntax, see [Search for files and folders](/workspace/drive/api/guides/search-files).',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
  'includeItemsFromAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether both My Drive and shared drive items should be included in results.',
  ),
  'includePermissionsForView' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Specifies which additional view\'s permissions to include in the response. Only `published` is supported.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The token for continuing a previous list request on the next page. This should be set to the value of `nextPageToken` from the previous response.',
  ),
  'teamDriveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Deprecated: Use `driveId` instead.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of sort keys. Valid keys are: * `createdTime`: When the file was created. Avoid using this key for queries on large item collections as it might result in timeouts or other issues. For time-related sorting on large item collections, use `modifiedTime desc` instead. * `folder`: The folder ID. This field is sorted using alphabetical ordering. * `modifiedByMeTime`: The last time the file was modified by the user. * `modifiedTime`: The last time the file was modified by anyone. * `name`: The name of the file. This field is sorted using alphabetical ordering, so 1, 12, 2, 22. * `name_natural`: The name of the file. This field is sorted using natural sort ordering, so 1, 2, 12, 22. * `quotaBytesUsed`: The number of storage quota bytes used by the file. * `recency`: The most recent timestamp from the file\'s date-time fields. * `sharedWithMeTime`: When the file was shared with the user, if applicable. * `starred`: Whether the user has starred the file. * `viewedByMeTime`: The last time the file was viewed by the user. Each key sorts ascending by default, but can be reversed with the `desc` modifier. Example usage: `?orderBy=folder,modifiedTime desc,name`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'supportsTeamDrives',
  1 => 'driveId',
  2 => 'pageSize',
  3 => 'corpus',
  4 => 'includeTeamDriveItems',
  5 => 'spaces',
  6 => 'includeLabels',
  7 => 'corpora',
  8 => 'q',
  9 => 'supportsAllDrives',
  10 => 'includeItemsFromAllDrives',
  11 => 'includePermissionsForView',
  12 => 'pageToken',
  13 => 'teamDriveId',
  14 => 'orderBy',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
