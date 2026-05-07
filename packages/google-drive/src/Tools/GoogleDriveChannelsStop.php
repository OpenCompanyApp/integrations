<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

/**
 * Channels Stop.
 *
 * Maps to the official Google Drive endpoint POST /drive/v3/channels/stop.
 */
class GoogleDriveChannelsStop extends AbstractGoogleDriveTool
{
    protected const NAME = 'google_drive_channels_stop';
    protected const DESCRIPTION = 'Channels Stop

Official Google Drive endpoint: POST /drive/v3/channels/stop
Stops watching resources through this channel. For more information, see [Notifications for resource changes](https://developers.google.com/workspace/drive/api/guides/push).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Drive API `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/drive/v3/channels/stop';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
