<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Comments Delete.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/files/{fileId}/comments/{commentId}.
 */
class GoogleDriveCommentsDelete extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_comments_delete';
    protected const DESCRIPTION = 'Comments Delete

Official Google Drive endpoint: DELETE /drive/v3/files/{fileId}/comments/{commentId}
Deletes a comment. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments).';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}';
    protected const PATH_PARAMS = array (
  0 => 'commentId',
  1 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
