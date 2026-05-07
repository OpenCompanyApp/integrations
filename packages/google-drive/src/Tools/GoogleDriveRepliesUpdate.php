<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Replies Update.
 *
 * Maps to the official Google Drive endpoint PATCH /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}.
 */
class GoogleDriveRepliesUpdate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_replies_update';
    protected const DESCRIPTION = 'Replies Update

Official Google Drive endpoint: PATCH /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}
Updates a reply with patch semantics. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments).';
    protected const PARAMETERS = array (
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
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Reply` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}';
    protected const PATH_PARAMS = array (
  0 => 'commentId',
  1 => 'replyId',
  2 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
