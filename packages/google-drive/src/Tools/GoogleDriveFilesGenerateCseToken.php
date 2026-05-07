<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Generate Cse Token.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/generateCseToken.
 */
class GoogleDriveFilesGenerateCseToken extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_generate_cse_token';
    protected const DESCRIPTION = 'Files Generate Cse Token

Official Google Drive endpoint: GET /drive/v3/files/generateCseToken
Generates a CSE token which can be used to create or update CSE files.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: fileId, parent.',
  ),
  'fileId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The ID of the file for which the JWT should be generated. If not provided, an id will be generated.',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The ID of the expected parent of the file. Used when generating a JWT for a new CSE file. If specified, the parent will be fetched, and if the parent is a shared drive item, the shared drive\'s policy will be used to determine the KACLS that should be used. It is invalid to specify both file_id and parent in a single request.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/generateCseToken';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'fileId',
  1 => 'parent',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
