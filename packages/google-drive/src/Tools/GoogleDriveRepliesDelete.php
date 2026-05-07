<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Replies Delete.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}.
 */
class GoogleDriveRepliesDelete extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_replies_delete';
    protected const DESCRIPTION = 'Replies Delete

Official Google Drive endpoint: DELETE /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}
Deletes a reply. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments).';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'commentId',
  2 => 'replyId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
