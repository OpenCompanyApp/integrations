<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Modify Labels.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/modifyLabels.
 */
class GoogleDriveFilesModifyLabels extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_modify_labels';
    protected const DESCRIPTION = 'Files Modify Labels

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/modifyLabels
Modifies the set of labels applied to a file. For more information, see [Set a label field on a file](https://developers.google.com/workspace/drive/api/guides/set-label). Returns a list of the labels that were added or modified.';
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
    'description' => 'JSON request body matching the official Google Drive API `ModifyLabelsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/modifyLabels';
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
