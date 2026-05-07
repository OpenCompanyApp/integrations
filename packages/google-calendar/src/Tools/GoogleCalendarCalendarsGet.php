<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendars Get.
 *
 * Maps to the official Calendar endpoint GET /calendars/{calendarId}.
 */
class GoogleCalendarCalendarsGet extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendars_get';
    protected const DESCRIPTION = 'Calendars Get

Official Calendar endpoint: GET /calendars/{calendarId}
Returns metadata for a calendar.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/calendars/{calendarId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
