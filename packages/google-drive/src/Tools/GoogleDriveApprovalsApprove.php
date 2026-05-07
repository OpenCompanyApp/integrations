<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals Approve.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/approvals/{approvalId}:approve.
 */
class GoogleDriveApprovalsApprove extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_approve';
    protected const DESCRIPTION = 'Approvals Approve

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/approvals/{approvalId}:approve
Approves an approval. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals). This is used to update the ReviewerResponse of the requesting user with a Response of `APPROVED`. If this is the last required reviewer response, this also completes the approval and sets the approval Status to `APPROVED`.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `ApproveApprovalRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/approvals/{approvalId}:approve';
    protected const PATH_PARAMS = array (
  0 => 'approvalId',
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
