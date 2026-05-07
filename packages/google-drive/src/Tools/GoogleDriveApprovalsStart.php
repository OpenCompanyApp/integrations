<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals Start.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/approvals:start.
 */
class GoogleDriveApprovalsStart extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_start';
    protected const DESCRIPTION = 'Approvals Start

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/approvals:start
Starts an approval on a file. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals).';
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
    'description' => 'JSON request body matching the official Google Drive API `StartApprovalRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/approvals:start';
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
