<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendars Update.
 *
 * Maps to the official Calendar endpoint PUT /calendars/{calendarId}.
 */
class GoogleCalendarCalendarsUpdate extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendars_update';
    protected const DESCRIPTION = 'Calendars Update

Official Calendar endpoint: PUT /calendars/{calendarId}
Updates metadata for a calendar.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Calendar` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/calendars/{calendarId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
