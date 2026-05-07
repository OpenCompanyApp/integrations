<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Accessproposals List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/accessproposals.
 */
class GoogleDriveAccessproposalsList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_accessproposals_list';
    protected const DESCRIPTION = 'Accessproposals List

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/accessproposals
List the access proposals on a file. For more information, see [Manage pending access proposals](https://developers.google.com/workspace/drive/api/guides/pending-access). Note: Only approvers are able to list access proposals on a file. If the user isn\'t an approver, a 403 error is returned.';
    protected const PARAMETERS = array (
  'fileId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `fileId` from the official Google Drive API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The number of results per page.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The continuation token on the list of access requests.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/accessproposals';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
