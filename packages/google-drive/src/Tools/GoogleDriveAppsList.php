<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Apps List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/apps.
 */
class GoogleDriveAppsList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_apps_list';
    protected const DESCRIPTION = 'Apps List

Official Google Drive endpoint: GET /drive/v3/apps
Lists a user\'s installed apps. For more information, see [Return user info](https://developers.google.com/workspace/drive/api/guides/user-info).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: appFilterMimeTypes, languageCode, appFilterExtensions.',
  ),
  'appFilterMimeTypes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of file extensions to limit returned results. All results within the given app query scope which can open any of the given MIME types will be included in the response. If `appFilterExtensions` are provided as well, the result is a union of the two resulting app lists.',
  ),
  'languageCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A language or locale code, as defined by BCP 47, with some extensions from Unicode\'s LDML format (http://www.unicode.org/reports/tr35/).',
  ),
  'appFilterExtensions' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of file extensions to limit returned results. All results within the given app query scope which can open any of the given file extensions are included in the response. If `appFilterMimeTypes` are provided as well, the result is a union of the two resulting app lists.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/apps';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'appFilterMimeTypes',
  1 => 'languageCode',
  2 => 'appFilterExtensions',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
