<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Files Generate Ids.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/files/generateIds.
 */
class GoogleDriveFilesGenerateIds extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_files_generate_ids';
    protected const DESCRIPTION = 'Files Generate Ids

Official Google Drive endpoint: GET /drive/v3/files/generateIds
Generates a set of file IDs which can be provided in create or copy requests. For more information, see [Create and manage files](https://developers.google.com/workspace/drive/api/guides/create-file).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: space, type, count.',
  ),
  'space' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The space in which the IDs can be used to create files. Supported values are `drive` and `appDataFolder`. (Default: `drive`.) For more information, see [File organization](https://developers.google.com/workspace/drive/api/guides/about-files#file-organization).',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The type of items which the IDs can be used for. Supported values are `files` and `shortcuts`. Note that `shortcuts` are only supported in the `drive` `space`. (Default: `files`.) For more information, see [File organization](https://developers.google.com/workspace/drive/api/guides/about-files#file-organization).',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The number of IDs to return.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/files/generateIds';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'space',
  1 => 'type',
  2 => 'count',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
