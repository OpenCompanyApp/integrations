<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendar List Watch.
 *
 * Maps to the official Calendar endpoint POST /users/me/calendarList/watch.
 */
class GoogleCalendarCalendarListWatch extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendar_list_watch';
    protected const DESCRIPTION = 'Calendar List Watch

Official Calendar endpoint: POST /users/me/calendarList/watch
Watch for changes to CalendarList resources.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: maxResults, showHidden, showDeleted, syncToken, minAccessRole, pageToken.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of entries returned on one result page. By default the value is 100 entries. The page size can never be larger than 250 entries. Optional.',
  ),
  'showHidden' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to show hidden entries. Optional. The default is False.',
  ),
  'showDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include deleted calendar list entries in the result. Optional. The default is False.',
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token obtained from the nextSyncToken field returned on the last page of results from the previous list request. It makes the result of this list request contain only entries that have changed since then. If only read-only fields such as calendar properties or ACLs have changed, the entry won\'t be returned. All entries deleted and hidden since the previous list request will always be in the result set and it is not allowed to set showDeleted neither showHidden to False. To ensure client state consistency minAccessRole query parameter cannot be specified together with nextSyncToken. If the syncToken expires, the server will respond with a 410 GONE response code and the client should clear its storage and perform a full synchronization without any syncToken. Learn more about incremental synchronization. Optional. The default is to return all entries.',
  ),
  'minAccessRole' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The minimum access role for the user in the returned entries. Optional. The default is no restriction.',
    'enum' =>
    array (
      0 => 'freeBusyReader',
      1 => 'owner',
      2 => 'reader',
      3 => 'writer',
    ),
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token specifying which result page to return. Optional.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/users/me/calendarList/watch';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'showHidden',
  2 => 'showDeleted',
  3 => 'syncToken',
  4 => 'minAccessRole',
  5 => 'pageToken',
);
    protected const BODY_REQUIRED = true;
}
