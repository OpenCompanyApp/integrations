<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Comments List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/comments.
 */
class GoogleDriveCommentsList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_comments_list';
    protected const DESCRIPTION = 'Comments List

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/comments
Lists a file\'s comments. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments). Required: The `fields` parameter must be set. To return the exact fields you need, see [Return specific fields](https://developers.google.com/workspace/drive/api/guides/fields-parameter).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageSize, pageToken, startModifiedTime, includeDeleted.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of comments to return per page.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The token for continuing a previous list request on the next page. This should be set to the value of \'nextPageToken\' from the previous response.',
  ),
  'startModifiedTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The minimum value of \'modifiedTime\' for the result comments (RFC 3339 date-time).',
  ),
  'includeDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include deleted comments. Deleted comments will not include their original content.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/comments';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'startModifiedTime',
  3 => 'includeDeleted',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
