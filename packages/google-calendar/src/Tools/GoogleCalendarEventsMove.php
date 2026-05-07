<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Move.
 *
 * Maps to the official Calendar endpoint POST /calendars/{calendarId}/events/{eventId}/move.
 */
class GoogleCalendarEventsMove extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_move';
    protected const DESCRIPTION = 'Events Move

Official Calendar endpoint: POST /calendars/{calendarId}/events/{eventId}/move
Moves an event to another calendar, i.e. changes an event\'s organizer. Note that only default events can be moved; birthday, focusTime, fromGmail, outOfOffice and workingLocation events cannot be moved.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: destination, sendNotifications, sendUpdates.',
  ),
  'destination' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Calendar identifier of the target calendar where the event is to be moved to.',
  ),
  'sendNotifications' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated. Please use sendUpdates instead. Whether to send notifications about the change of the event\'s organizer. Note that some emails might still be sent even if you set the value to false. The default is false.',
  ),
  'sendUpdates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Guests who should receive notifications about the change of the event\'s organizer.',
    'enum' =>
    array (
      0 => 'all',
      1 => 'externalOnly',
      2 => 'none',
    ),
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/calendars/{calendarId}/events/{eventId}/move';
    protected const PATH_PARAMS = array (
  0 => 'eventId',
  1 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'destination',
  1 => 'sendNotifications',
  2 => 'sendUpdates',
);
    protected const BODY_REQUIRED = false;
}
