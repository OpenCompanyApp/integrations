<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Settings Watch.
 *
 * Maps to the official Calendar endpoint POST /users/me/settings/watch.
 */
class GoogleCalendarSettingsWatch extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_settings_watch';
    protected const DESCRIPTION = 'Settings Watch

Official Calendar endpoint: POST /users/me/settings/watch
Watch for changes to Settings resources.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: syncToken, pageToken, maxResults.',
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token obtained from the nextSyncToken field returned on the last page of results from the previous list request. It makes the result of this list request contain only entries that have changed since then. If the syncToken expires, the server will respond with a 410 GONE response code and the client should clear its storage and perform a full synchronization without any syncToken. Learn more about incremental synchronization. Optional. The default is to return all entries.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token specifying which result page to return. Optional.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of entries returned on one result page. By default the value is 100 entries. The page size can never be larger than 250 entries. Optional.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/users/me/settings/watch';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'syncToken',
  1 => 'pageToken',
  2 => 'maxResults',
);
    protected const BODY_REQUIRED = true;
}
