<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Instances.
 *
 * Maps to the official Calendar endpoint GET /calendars/{calendarId}/events/{eventId}/instances.
 */
class GoogleCalendarEventsInstances extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_instances';
    protected const DESCRIPTION = 'Events Instances

Official Calendar endpoint: GET /calendars/{calendarId}/events/{eventId}/instances
Returns instances of the specified recurring event.';
    protected const PARAMETERS = array (
  'eventId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `eventId` from the official Calendar API method.',
  ),
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: pageToken, timeMax, maxResults, alwaysIncludeEmail, maxAttendees, showDeleted, originalStart, timeMin, timeZone.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token specifying which result page to return. Optional.',
  ),
  'timeMax' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Upper bound (exclusive) for an event\'s start time to filter by. Optional. The default is not to filter by start time. Must be an RFC3339 timestamp with mandatory time zone offset.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of events returned on one result page. By default the value is 250 events. The page size can never be larger than 2500 events. Optional.',
  ),
  'alwaysIncludeEmail' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated and ignored. A value will always be returned in the email field for the organizer, creator and attendees, even if no real email address is available (i.e. a generated, non-working value will be provided).',
  ),
  'maxAttendees' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of attendees to include in the response. If there are more than the specified number of attendees, only the participant is returned. Optional.',
  ),
  'showDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include deleted events (with status equals "cancelled") in the result. Cancelled instances of recurring events will still be included if singleEvents is False. Optional. The default is False.',
  ),
  'originalStart' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The original start time of the instance in the result. Optional.',
  ),
  'timeMin' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lower bound (inclusive) for an event\'s end time to filter by. Optional. The default is not to filter by end time. Must be an RFC3339 timestamp with mandatory time zone offset.',
  ),
  'timeZone' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Time zone used in the response. Optional. The default is the time zone of the calendar.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/calendars/{calendarId}/events/{eventId}/instances';
    protected const PATH_PARAMS = array (
  0 => 'eventId',
  1 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'timeMax',
  2 => 'maxResults',
  3 => 'alwaysIncludeEmail',
  4 => 'maxAttendees',
  5 => 'showDeleted',
  6 => 'originalStart',
  7 => 'timeMin',
  8 => 'timeZone',
);
    protected const BODY_REQUIRED = false;
}
