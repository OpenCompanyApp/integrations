<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Delete.
 *
 * Maps to the official Calendar endpoint DELETE /calendars/{calendarId}/events/{eventId}.
 */
class GoogleCalendarEventsDelete extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_delete';
    protected const DESCRIPTION = 'Events Delete

Official Calendar endpoint: DELETE /calendars/{calendarId}/events/{eventId}
Deletes an event.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: sendNotifications, sendUpdates.',
  ),
  'sendNotifications' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated. Please use sendUpdates instead. Whether to send notifications about the deletion of the event. Note that some emails might still be sent even if you set the value to false. The default is false.',
  ),
  'sendUpdates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Guests who should receive notifications about the deletion of the event.',
    'enum' =>
    array (
      0 => 'all',
      1 => 'externalOnly',
      2 => 'none',
    ),
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/calendars/{calendarId}/events/{eventId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
  1 => 'eventId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'sendNotifications',
  1 => 'sendUpdates',
);
    protected const BODY_REQUIRED = false;
}
