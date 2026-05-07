<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/approvals/{approvalId}.
 */
class GoogleDriveApprovalsGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_get';
    protected const DESCRIPTION = 'Approvals Get

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/approvals/{approvalId}
Gets an approval by ID. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals).';
    protected const PARAMETERS = array (
  'approvalId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `approvalId` from the official Google Drive API method.',
  ),
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/approvals/{approvalId}';
    protected const PATH_PARAMS = array (
  0 => 'approvalId',
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
