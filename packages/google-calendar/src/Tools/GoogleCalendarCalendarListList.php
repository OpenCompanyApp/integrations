<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendar List List.
 *
 * Maps to the official Calendar endpoint GET /users/me/calendarList.
 */
class GoogleCalendarCalendarListList extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendar_list_list';
    protected const DESCRIPTION = 'Calendar List List

Official Calendar endpoint: GET /users/me/calendarList
Returns the calendars on the user\'s calendar list.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: showHidden, maxResults, syncToken, minAccessRole, pageToken, showDeleted.',
  ),
  'showHidden' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to show hidden entries. Optional. The default is False.',
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
  'showDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include deleted calendar list entries in the result. Optional. The default is False.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/users/me/calendarList';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'showHidden',
  1 => 'maxResults',
  2 => 'syncToken',
  3 => 'minAccessRole',
  4 => 'pageToken',
  5 => 'showDeleted',
);
    protected const BODY_REQUIRED = false;
}
