<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Revisions Delete.
 *
 * Maps to the official Google Drive endpoint DELETE /drive/v3/files/{fileId}/revisions/{revisionId}.
 */
class GoogleDriveRevisionsDelete extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_revisions_delete';
    protected const DESCRIPTION = 'Revisions Delete

Official Google Drive endpoint: DELETE /drive/v3/files/{fileId}/revisions/{revisionId}
Permanently deletes a file version. You can only delete revisions for files with binary content in Google Drive, like images or videos. Revisions for other files, like Google Docs or Sheets, and the last remaining file version can\'t be deleted. For more information, see [Manage file revisions](https://developers.google.com/drive/api/guides/manage-revisions).';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/drive/v3/files/{fileId}/revisions/{revisionId}';
    protected const PATH_PARAMS = array (
  0 => 'revisionId',
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
