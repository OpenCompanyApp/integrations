<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Revisions Update.
 *
 * Maps to the official Google Drive endpoint PATCH /drive/v3/files/{fileId}/revisions/{revisionId}.
 */
class GoogleDriveRevisionsUpdate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_revisions_update';
    protected const DESCRIPTION = 'Revisions Update

Official Google Drive endpoint: PATCH /drive/v3/files/{fileId}/revisions/{revisionId}
Updates a revision with patch semantics. For more information, see [Manage file revisions](https://developers.google.com/workspace/drive/api/guides/manage-revisions).';
    protected const PARAMETERS = array (
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'revisionId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `revisionId` from the official Google Drive API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Revision` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/drive/v3/files/{fileId}/revisions/{revisionId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'revisionId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
