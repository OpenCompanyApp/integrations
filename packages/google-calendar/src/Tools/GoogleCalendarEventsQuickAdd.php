<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Quick Add.
 *
 * Maps to the official Calendar endpoint POST /calendars/{calendarId}/events/quickAdd.
 */
class GoogleCalendarEventsQuickAdd extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_quick_add';
    protected const DESCRIPTION = 'Events Quick Add

Official Calendar endpoint: POST /calendars/{calendarId}/events/quickAdd
Creates an event based on a simple text string.';
    protected const PARAMETERS = array (
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: text, sendUpdates, sendNotifications.',
  ),
  'text' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The text describing the event to be created.',
  ),
  'sendUpdates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Guests who should receive notifications about the creation of the new event.',
    'enum' =>
    array (
      0 => 'all',
      1 => 'externalOnly',
      2 => 'none',
    ),
  ),
  'sendNotifications' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated. Please use sendUpdates instead. Whether to send notifications about the creation of the event. Note that some emails might still be sent even if you set the value to false. The default is false.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/calendars/{calendarId}/events/quickAdd';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'text',
  1 => 'sendUpdates',
  2 => 'sendNotifications',
);
    protected const BODY_REQUIRED = false;
}
