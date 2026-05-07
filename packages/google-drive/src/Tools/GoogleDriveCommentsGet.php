<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Comments Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/comments/{commentId}.
 */
class GoogleDriveCommentsGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_comments_get';
    protected const DESCRIPTION = 'Comments Get

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/comments/{commentId}
Gets a comment by ID. For more information, see [Manage comments and replies](https://developers.google.com/workspace/drive/api/guides/manage-comments). Required: The `fields` parameter must be set. To return the exact fields you need, see [Return specific fields](https://developers.google.com/workspace/drive/api/guides/fields-parameter).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: includeDeleted.',
  ),
  'includeDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to return deleted comments. Deleted comments will not include their original content.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/comments/{commentId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'commentId',
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
