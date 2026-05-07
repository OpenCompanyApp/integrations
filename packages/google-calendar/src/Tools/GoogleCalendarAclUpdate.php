<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Acl Update.
 *
 * Maps to the official Calendar endpoint PUT /calendars/{calendarId}/acl/{ruleId}.
 */
class GoogleCalendarAclUpdate extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_acl_update';
    protected const DESCRIPTION = 'Acl Update

Official Calendar endpoint: PUT /calendars/{calendarId}/acl/{ruleId}
Updates an access control rule.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
  'ruleId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ruleId` from the official Calendar API method.',
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
    'description' => 'Whether to send notifications about the calendar sharing change. Note that there are no notifications on access removal. Optional. The default is True.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `AclRule` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/calendars/{calendarId}/acl/{ruleId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
  1 => 'ruleId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'sendNotifications',
);
    protected const BODY_REQUIRED = true;
}
