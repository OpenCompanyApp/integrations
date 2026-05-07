<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals Decline.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/approvals/{approvalId}:decline.
 */
class GoogleDriveApprovalsDecline extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_decline';
    protected const DESCRIPTION = 'Approvals Decline

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/approvals/{approvalId}:decline
Declines an approval. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals). This is used to update the ReviewerResponse of the requesting user with a Response of `DECLINED`. This also completes the approval and sets the approval Status to `DECLINED`.';
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
    'description' => 'JSON request body matching the official Google Drive API `DeclineApprovalRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/approvals/{approvalId}:decline';
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
