<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Channels Stop.
 *
 * Maps to the official Calendar endpoint POST /channels/stop.
 */
class GoogleCalendarChannelsStop extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_channels_stop';
    protected const DESCRIPTION = 'Channels Stop

Official Calendar endpoint: POST /channels/stop
Stop watching resources through this channel';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Channel` schema.',
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
}
