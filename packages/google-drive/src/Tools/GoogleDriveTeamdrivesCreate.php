<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Teamdrives Create.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/teamdrives.
 */
class GoogleDriveTeamdrivesCreate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_teamdrives_create';
    protected const DESCRIPTION = 'Teamdrives Create

Official Google Drive endpoint: POST /drive/v3/teamdrives
Deprecated: Use `drives.create` instead.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: requestId.',
  ),
  'requestId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Required. An ID, such as a random UUID, which uniquely identifies this user\'s request for idempotent creation of a Team Drive. A repeated request by the same user and with the same request ID will avoid creating duplicates by attempting to create the same Team Drive. If the Team Drive already exists a 409 error will be returned.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `TeamDrive` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/teamdrives';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'requestId',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
