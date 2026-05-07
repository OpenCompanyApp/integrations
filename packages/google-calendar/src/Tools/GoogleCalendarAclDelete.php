<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Acl Delete.
 *
 * Maps to the official Calendar endpoint DELETE /calendars/{calendarId}/acl/{ruleId}.
 */
class GoogleCalendarAclDelete extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_acl_delete';
    protected const DESCRIPTION = 'Acl Delete

Official Calendar endpoint: DELETE /calendars/{calendarId}/acl/{ruleId}
Deletes an access control rule.';
    protected const PARAMETERS = array (
  'ruleId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ruleId` from the official Calendar API method.',
  ),
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/calendars/{calendarId}/acl/{ruleId}';
    protected const PATH_PARAMS = array (
  0 => 'ruleId',
  1 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
