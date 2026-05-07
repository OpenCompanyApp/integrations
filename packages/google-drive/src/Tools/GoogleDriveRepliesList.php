<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Replies List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/comments/{commentId}/replies.
 */
class GoogleDriveRepliesList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_replies_list';
    protected const DESCRIPTION = 'Replies List

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/comments/{commentId}/replies
Lists a comment\'s replies. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments).';
    protected const PARAMETERS = array (
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'commentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `commentId` from the official Google Drive API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageToken, includeDeleted, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The token for continuing a previous list request on the next page. This should be set to the value of `nextPageToken` from the previous response.',
  ),
  'includeDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include deleted replies. Deleted replies don\'t include their original content.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of replies to return per page.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}/replies';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'commentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'includeDeleted',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
