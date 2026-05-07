<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Acl Patch.
 *
 * Maps to the official Calendar endpoint PATCH /calendars/{calendarId}/acl/{ruleId}.
 */
class GoogleCalendarAclPatch extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_acl_patch';
    protected const DESCRIPTION = 'Acl Patch

Official Calendar endpoint: PATCH /calendars/{calendarId}/acl/{ruleId}
Updates an access control rule. This method supports patch semantics.';
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
    protected const METHOD = 'PATCH';
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
