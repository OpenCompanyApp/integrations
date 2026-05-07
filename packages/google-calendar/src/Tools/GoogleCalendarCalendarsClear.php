<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendars Clear.
 *
 * Maps to the official Calendar endpoint POST /calendars/{calendarId}/clear.
 */
class GoogleCalendarCalendarsClear extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendars_clear';
    protected const DESCRIPTION = 'Calendars Clear

Official Calendar endpoint: POST /calendars/{calendarId}/clear
Clears a primary calendar. This operation deletes all events associated with the primary calendar of an account.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/calendars/{calendarId}/clear';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
