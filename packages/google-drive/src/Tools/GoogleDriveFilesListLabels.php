<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files List Labels.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/listLabels.
 */
class GoogleDriveFilesListLabels extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_list_labels';
    protected const DESCRIPTION = 'Files List Labels

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/listLabels
Lists the labels on a file. For more information, see [List labels on a file](https://developers.google.com/workspace/drive/api/guides/list-labels).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageToken, maxResults.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The token for continuing a previous list request on the next page. This should be set to the value of `nextPageToken` from the previous response.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of labels to return per page. When not set, defaults to 100.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/listLabels';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
