<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals Comment.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/approvals/{approvalId}:comment.
 */
class GoogleDriveApprovalsComment extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_comment';
    protected const DESCRIPTION = 'Approvals Comment

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/approvals/{approvalId}:comment
Comments on an approval. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals). This sends a notification to both the initiator and the reviewers. Additionally, a message is also added to the approval activity log.';
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
    'description' => 'JSON request body matching the official Google Drive API `CommentApprovalRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/approvals/{approvalId}:comment';
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
