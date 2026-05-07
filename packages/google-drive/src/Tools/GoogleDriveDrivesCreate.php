<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Drives Create.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/drives.
 */
class GoogleDriveDrivesCreate extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_drives_create';
    protected const DESCRIPTION = 'Drives Create

Official Google Drive endpoint: POST /drive/v3/drives
Creates a shared drive. For more information, see [Manage shared drives](https://developers.google.com/workspace/drive/api/guides/manage-shareddrives).';
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
    'description' => 'Required. An ID, such as a random UUID, which uniquely identifies this user\'s request for idempotent creation of a shared drive. A repeated request by the same user and with the same request ID will avoid creating duplicates by attempting to create the same shared drive. If the shared drive already exists a 409 error will be returned.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Drive` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/drives';
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
