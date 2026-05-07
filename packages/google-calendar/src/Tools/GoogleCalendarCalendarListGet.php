<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendar List Get.
 *
 * Maps to the official Calendar endpoint GET /users/me/calendarList/{calendarId}.
 */
class GoogleCalendarCalendarListGet extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendar_list_get';
    protected const DESCRIPTION = 'Calendar List Get

Official Calendar endpoint: GET /users/me/calendarList/{calendarId}
Returns a calendar from the user\'s calendar list.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/users/me/calendarList/{calendarId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
