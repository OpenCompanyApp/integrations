<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Comments Update.
 *
 * Maps to the official Google Drive endpoint PATCH /drive/v3/files/{fileId}/comments/{commentId}.
 */
class GoogleDriveCommentsUpdate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_comments_update';
    protected const DESCRIPTION = 'Comments Update

Official Google Drive endpoint: PATCH /drive/v3/files/{fileId}/comments/{commentId}
Updates a comment with patch semantics. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments). Required: The `fields` parameter must be set. To return the exact fields you need, see [Return specific fields](https://developers.google.com/workspace/drive/api/guides/fields-parameter).';
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
    'description' => 'JSON request body matching the official Google Drive API `Comment` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}';
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
