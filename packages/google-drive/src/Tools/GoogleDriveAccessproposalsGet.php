<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Accessproposals Get.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/accessproposals/{proposalId}.
 */
class GoogleDriveAccessproposalsGet extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_accessproposals_get';
    protected const DESCRIPTION = 'Accessproposals Get

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/accessproposals/{proposalId}
Retrieves an access proposal by ID. For more information, see [Manage pending access proposals](https://developers.google.com/workspace/drive/api/guides/pending-access).';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/accessproposals/{proposalId}';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
  1 => 'proposalId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
