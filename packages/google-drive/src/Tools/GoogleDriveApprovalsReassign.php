<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals Reassign.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/approvals/{approvalId}:reassign.
 */
class GoogleDriveApprovalsReassign extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_reassign';
    protected const DESCRIPTION = 'Approvals Reassign

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/approvals/{approvalId}:reassign
Reassigns the reviewers on an approval. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals). Adds or replaces reviewers in the ReviewerResponse of the approval. This can be called by any user with the `writer` permission on the file while the approval Status is `IN_PROGRESS` and the Response for the reviewer being reassigned is `NO_RESPONSE`. A user with the `reader` permission can only reassign an approval that\'s assigned to themselves. Removing a reviewer isn\'t allowed.';
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
    'description' => 'JSON request body matching the official Google Drive API `ReassignApprovalRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/approvals/{approvalId}:reassign';
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
