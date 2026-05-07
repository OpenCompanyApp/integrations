<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Replies Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}.
 */
class GoogleDriveRepliesGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_replies_get';
    protected const DESCRIPTION = 'Replies Get

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}
Gets a reply by ID. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments).';
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
  'replyId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `replyId` from the official Google Drive API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: includeDeleted.',
  ),
  'includeDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to return deleted replies. Deleted replies don\'t include their original content.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'commentId',
  2 => 'replyId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includeDeleted',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
