<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Get.
 *
 * Maps to the official Calendar endpoint GET /calendars/{calendarId}/events/{eventId}.
 */
class GoogleCalendarEventsGet extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_get';
    protected const DESCRIPTION = 'Events Get

Official Calendar endpoint: GET /calendars/{calendarId}/events/{eventId}
Returns an event based on its Google Calendar ID. To retrieve an event using its iCalendar ID, call the events.list method using the iCalUID parameter.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
  'eventId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `eventId` from the official Calendar API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: alwaysIncludeEmail, timeZone, maxAttendees.',
  ),
  'alwaysIncludeEmail' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated and ignored. A value will always be returned in the email field for the organizer, creator and attendees, even if no real email address is available (i.e. a generated, non-working value will be provided).',
  ),
  'timeZone' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Time zone used in the response. Optional. The default is the time zone of the calendar.',
  ),
  'maxAttendees' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of attendees to include in the response. If there are more than the specified number of attendees, only the participant is returned. Optional.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/calendars/{calendarId}/events/{eventId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
  1 => 'eventId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'alwaysIncludeEmail',
  1 => 'timeZone',
  2 => 'maxAttendees',
);
    protected const BODY_REQUIRED = false;
}
