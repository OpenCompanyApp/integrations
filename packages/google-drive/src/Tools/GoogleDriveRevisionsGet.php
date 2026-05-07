<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Revisions Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/revisions/{revisionId}.
 */
class GoogleDriveRevisionsGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_revisions_get';
    protected const DESCRIPTION = 'Revisions Get

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/revisions/{revisionId}
Gets a revision\'s metadata or content by ID. For more information, see [Manage file revisions](https://developers.google.com/workspace/drive/api/guides/manage-revisions).';
    protected const PARAMETERS = array (
  'revisionId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `revisionId` from the official Google Drive API method.',
  ),
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: acknowledgeAbuse.',
  ),
  'acknowledgeAbuse' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the user is acknowledging the risk of downloading known malware or other abusive files. This is only applicable when the `alt` parameter is set to `media` and the user is the owner of the file or an organizer of the shared drive in which the file resides.',
  ),
  'alt' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Use `media` for raw file/revision content where the Drive method supports media download.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/revisions/{revisionId}';
    protected const PATH_PARAMS = array (
  0 => 'revisionId',
  1 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'acknowledgeAbuse',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
