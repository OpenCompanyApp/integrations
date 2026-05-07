<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Acl List.
 *
 * Maps to the official Calendar endpoint GET /calendars/{calendarId}/acl.
 */
class GoogleCalendarAclList extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_acl_list';
    protected const DESCRIPTION = 'Acl List

Official Calendar endpoint: GET /calendars/{calendarId}/acl
Returns the rules in the access control list for the calendar.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: maxResults, showDeleted, pageToken, syncToken.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of entries returned on one result page. By default the value is 100 entries. The page size can never be larger than 250 entries. Optional.',
  ),
  'showDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include deleted ACLs in the result. Deleted ACLs are represented by role equal to "none". Deleted ACLs will always be included if syncToken is provided. Optional. The default is False.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token specifying which result page to return. Optional.',
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token obtained from the nextSyncToken field returned on the last page of results from the previous list request. It makes the result of this list request contain only entries that have changed since then. All entries deleted since the previous list request will always be in the result set and it is not allowed to set showDeleted to False. If the syncToken expires, the server will respond with a 410 GONE response code and the client should clear its storage and perform a full synchronization without any syncToken. Learn more about incremental synchronization. Optional. The default is to return all entries.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/calendars/{calendarId}/acl';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'showDeleted',
  2 => 'pageToken',
  3 => 'syncToken',
);
    protected const BODY_REQUIRED = false;
}
