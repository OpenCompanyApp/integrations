<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Channels Stop.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory_v1/channels/stop.
 */
class GoogleWorkspaceAdminChannelsStop extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_channels_stop';
    protected const DESCRIPTION = 'Channels Stop

Official Workspace Admin endpoint: POST /admin/directory_v1/channels/stop
Stops watching resources through this channel.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory_v1/channels/stop';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}