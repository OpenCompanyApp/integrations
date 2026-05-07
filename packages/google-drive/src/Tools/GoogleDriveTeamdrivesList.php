<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Teamdrives List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/teamdrives.
 */
class GoogleDriveTeamdrivesList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_teamdrives_list';
    protected const DESCRIPTION = 'Teamdrives List

Official Google Drive endpoint: GET /drive/v3/teamdrives
Deprecated: Use `drives.list` instead.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageToken, pageSize, q, useDomainAdminAccess.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Page token for Team Drives.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of Team Drives to return.',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query string for searching Team Drives.',
  ),
  'useDomainAdminAccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Issue the request as a domain administrator; if set to true, then all Team Drives of the domain in which the requester is an administrator are returned.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/teamdrives';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
  2 => 'q',
  3 => 'useDomainAdminAccess',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
