<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Changes Watch.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/changes/watch.
 */
class GoogleDriveChangesWatch extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_changes_watch';
    protected const DESCRIPTION = 'Changes Watch

Official Google Drive endpoint: POST /drive/v3/changes/watch
Subscribes to changes for a user. For more information, see [Notifications for resource changes](https://developers.google.com/workspace/drive/api/guides/push).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Drive method. Known keys: pageSize, driveId, restrictToMyDrive, supportsTeamDrives, includeTeamDriveItems, spaces, includeLabels, includeItemsFromAllDrives, includePermissionsForView, supportsAllDrives, includeRemoved, includeCorpusRemovals, pageToken, teamDriveId.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of changes to return per page.',
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
  'supportsTeamDrives' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated: Use `supportsAllDrives` instead.',
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
  'includeRemoved' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include changes indicating that items have been removed from the list of changes, for example by deletion or loss of access.',
  ),
  'includeCorpusRemovals' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether changes should include the file resource if the file is still accessible by the user at the time of the request, even when a file was removed from the list of changes and there will be no further change entries for this file.',
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/changes/watch';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'driveId',
  2 => 'restrictToMyDrive',
  3 => 'supportsTeamDrives',
  4 => 'includeTeamDriveItems',
  5 => 'spaces',
  6 => 'includeLabels',
  7 => 'includeItemsFromAllDrives',
  8 => 'includePermissionsForView',
  9 => 'supportsAllDrives',
  10 => 'includeRemoved',
  11 => 'includeCorpusRemovals',
  12 => 'pageToken',
  13 => 'teamDriveId',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
