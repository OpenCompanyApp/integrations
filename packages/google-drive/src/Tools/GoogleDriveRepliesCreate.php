<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Replies Create.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/comments/{commentId}/replies.
 */
class GoogleDriveRepliesCreate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_replies_create';
    protected const DESCRIPTION = 'Replies Create

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/comments/{commentId}/replies
Creates a reply to a comment. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments).';
    protected const PARAMETERS = array (
  'commentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `commentId` from the official Google Drive API method.',
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
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}/replies';
    protected const PATH_PARAMS = array (
  0 => 'commentId',
  1 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
