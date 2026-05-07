<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Changes List.
 *
 * Maps to the official Google Drive endpoint GET /drive/v3/changes.
 */
class GoogleDriveChangesList extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_changes_list';
    protected const DESCRIPTION = 'Changes List

Official Google Drive endpoint: GET /drive/v3/changes
Lists the changes for a user or shared drive. For more information, see [Retrieve changes](https://developers.google.com/workspace/drive/api/guides/manage-changes).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageToken, teamDriveId, includeCorpusRemovals, includeRemoved, includeItemsFromAllDrives, includePermissionsForView, supportsAllDrives, includeTeamDriveItems, spaces, includeLabels, supportsTeamDrives, driveId, restrictToMyDrive, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The token for continuing a previous list request on the next page. This should be set to the value of \'nextPageToken\' from the previous response or to the response from the getStartPageToken method.',
  ),
  'teamDriveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Deprecated: Use `driveId` instead.',
  ),
  'includeCorpusRemovals' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether changes should include the file resource if the file is still accessible by the user at the time of the request, even when a file was removed from the list of changes and there will be no further change entries for this file.',
  ),
  'includeRemoved' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include changes indicating that items have been removed from the list of changes, for example by deletion or loss of access.',
  ),
  'includeItemsFromAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether both My Drive and shared drive items should be included in results.',
  ),
  'includePermissionsForView' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Specifies which additional view\'s permissions to include in the response. Only \'published\' is supported.',
  ),
  'supportsAllDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether the requesting application supports both My Drives and shared drives.',
  ),
  'includeTeamDriveItems' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `includeItemsFromAllDrives` instead.',
  ),
  'spaces' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of spaces to query within the corpora. Supported values are \'drive\' and \'appDataFolder\'.',
  ),
  'includeLabels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of IDs of labels to include in the `labelInfo` part of the response.',
  ),
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
  ),
  'driveId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The shared drive from which changes will be returned. If specified the change IDs will be reflective of the shared drive; use the combined drive ID and change ID as an identifier.',
  ),
  'restrictToMyDrive' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to restrict the results to changes inside the My Drive hierarchy. This omits changes to files such as those in the Application Data folder or shared files which have not been added to My Drive.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of changes to return per page.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/drive/v3/changes';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'teamDriveId',
  2 => 'includeCorpusRemovals',
  3 => 'includeRemoved',
  4 => 'includeItemsFromAllDrives',
  5 => 'includePermissionsForView',
  6 => 'supportsAllDrives',
  7 => 'includeTeamDriveItems',
  8 => 'spaces',
  9 => 'includeLabels',
  10 => 'supportsTeamDrives',
  11 => 'driveId',
  12 => 'restrictToMyDrive',
  13 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
