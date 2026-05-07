<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendars Patch.
 *
 * Maps to the official Calendar endpoint PATCH /calendars/{calendarId}.
 */
class GoogleCalendarCalendarsPatch extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendars_patch';
    protected const DESCRIPTION = 'Calendars Patch

Official Calendar endpoint: PATCH /calendars/{calendarId}
Updates metadata for a calendar. This method supports patch semantics.';
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
    protected const METHOD = 'PATCH';
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
