<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals Cancel.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/approvals/{approvalId}:cancel.
 */
class GoogleDriveApprovalsCancel extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_cancel';
    protected const DESCRIPTION = 'Approvals Cancel

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/approvals/{approvalId}:cancel
Cancels an approval. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals). Updates the approval Status to `CANCELLED`. This can be called by any user with the `writer` permission on the file while the approval Status is `IN_PROGRESS`.';
    protected const PARAMETERS = array (
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'approvalId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `approvalId` from the official Google Drive API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `CancelApprovalRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/approvals/{approvalId}:cancel';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'approvalId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
