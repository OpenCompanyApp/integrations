<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Acl Get.
 *
 * Maps to the official Calendar endpoint GET /calendars/{calendarId}/acl/{ruleId}.
 */
class GoogleCalendarAclGet extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_acl_get';
    protected const DESCRIPTION = 'Acl Get

Official Calendar endpoint: GET /calendars/{calendarId}/acl/{ruleId}
Returns an access control rule.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/calendars/{calendarId}/acl/{ruleId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
  1 => 'ruleId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
