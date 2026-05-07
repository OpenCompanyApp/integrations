<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Comments Create.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/comments.
 */
class GoogleDriveCommentsCreate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_comments_create';
    protected const DESCRIPTION = 'Comments Create

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/comments
Creates a comment on a file. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments). Required: The `fields` parameter must be set. To return the exact fields you need, see [Return specific fields](https://developers.google.com/workspace/drive/api/guides/fields-parameter).';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/comments';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
