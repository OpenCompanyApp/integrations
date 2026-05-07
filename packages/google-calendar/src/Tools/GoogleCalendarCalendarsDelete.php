<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendars Delete.
 *
 * Maps to the official Calendar endpoint DELETE /calendars/{calendarId}.
 */
class GoogleCalendarCalendarsDelete extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendars_delete';
    protected const DESCRIPTION = 'Calendars Delete

Official Calendar endpoint: DELETE /calendars/{calendarId}
Deletes a secondary calendar. Use calendars.clear for clearing all events on primary calendars.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
);
    protected const METHOD = 'DELETE';
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
