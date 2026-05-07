<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Acl Insert.
 *
 * Maps to the official Calendar endpoint POST /calendars/{calendarId}/acl.
 */
class GoogleCalendarAclInsert extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_acl_insert';
    protected const DESCRIPTION = 'Acl Insert

Official Calendar endpoint: POST /calendars/{calendarId}/acl
Creates an access control rule.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: sendNotifications.',
  ),
  'sendNotifications' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to send notifications about the calendar sharing change. Optional. The default is True.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `AclRule` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/calendars/{calendarId}/acl';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'sendNotifications',
);
    protected const BODY_REQUIRED = true;
}
