<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Approvals List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/{fileId}/approvals.
 */
class GoogleDriveApprovalsList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_approvals_list';
    protected const DESCRIPTION = 'Approvals List

Official Google Drive endpoint: GET /drive/v3/files/{fileId}/approvals
Lists the approvals on a file. For more information, see [Manage approvals](https://developers.google.com/workspace/drive/api/guides/approvals).';
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
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageToken, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The token for continuing a previous list request on the next page. This should be set to the value of `nextPageToken` from a previous response.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of approvals to return. When not set, at most 100 approvals are returned.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/{fileId}/approvals';
    protected const PATH_PARAMS = array (
  0 => 'fileId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
