<?php

namespace OpenCompany\Integrations\GoogleCloudStorage\Tools;

/**
 * Channels Stop.
 *
 * Maps to the official Cloud Storage endpoint POST /channels/stop.
 */
class GoogleCloudStorageChannelsStop extends AbstractGoogleCloudStorageTool
{
    protected const NAME = 'google_cloud_storage_channels_stop';
    protected const DESCRIPTION = 'Channels Stop

Official Cloud Storage endpoint: POST /channels/stop
Stop watching resources through this channel';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Storage `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/channels/stop';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_DOWNLOAD = false;
    protected const UPLOAD_PATH = '';
}
