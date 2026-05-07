<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Drives List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/drives.
 */
class GoogleDriveDrivesList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_drives_list';
    protected const DESCRIPTION = 'Drives List

Official Google Drive endpoint: GET /drive/v3/drives
Lists the user\'s shared drives. This method accepts the `q` parameter, which is a search query combining one or more search terms. For more information, see the [Search for shared drives](https://developers.google.com/workspace/drive/api/guides/search-shareddrives) guide.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: useDomainAdminAccess, pageToken, pageSize, q.',
  ),
  'useDomainAdminAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Issue the request as a domain administrator; if set to true, then all shared drives of the domain in which the requester is an administrator are returned.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Page token for shared drives.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of shared drives to return per page.',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query string for searching shared drives.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/drives';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'useDomainAdminAccess',
  1 => 'pageToken',
  2 => 'pageSize',
  3 => 'q',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
