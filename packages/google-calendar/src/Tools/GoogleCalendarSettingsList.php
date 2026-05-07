<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Settings List.
 *
 * Maps to the official Calendar endpoint GET /users/me/settings.
 */
class GoogleCalendarSettingsList extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_settings_list';
    protected const DESCRIPTION = 'Settings List

Official Calendar endpoint: GET /users/me/settings
Returns all user settings for the authenticated user.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: maxResults, syncToken, pageToken.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of entries returned on one result page. By default the value is 100 entries. The page size can never be larger than 250 entries. Optional.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/users/me/settings';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'syncToken',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
