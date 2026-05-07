<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Accessproposals Resolve.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/files/{fileId}/accessproposals/{proposalId}:resolve.
 */
class GoogleDriveAccessproposalsResolve extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_accessproposals_resolve';
    protected const DESCRIPTION = 'Accessproposals Resolve

Official Google Drive endpoint: POST /drive/v3/files/{fileId}/accessproposals/{proposalId}:resolve
Approves or denies an access proposal. For more information, see [Manage pending access proposals](https://developers.google.com/workspace/drive/api/guides/pending-access).';
    protected const PARAMETERS = array (
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'proposalId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `proposalId` from the official Google Drive API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `ResolveAccessProposalRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/files/{fileId}/accessproposals/{proposalId}:resolve';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'proposalId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
