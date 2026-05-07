<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Insert.
 *
 * Maps to the official Calendar endpoint POST /calendars/{calendarId}/events.
 */
class GoogleCalendarEventsInsert extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_insert';
    protected const DESCRIPTION = 'Events Insert

Official Calendar endpoint: POST /calendars/{calendarId}/events
Creates an event.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: maxAttendees, conferenceDataVersion, sendNotifications, supportsAttachments, sendUpdates.',
  ),
  'maxAttendees' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of attendees to include in the response. If there are more than the specified number of attendees, only the participant is returned. Optional.',
  ),
  'conferenceDataVersion' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Version number of conference data supported by the API client. Version 0 assumes no conference data support and ignores conference data in the event\'s body. Version 1 enables support for copying of ConferenceData as well as for creating new conferences using the createRequest field of conferenceData. The default is 0.',
  ),
  'sendNotifications' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated. Please use sendUpdates instead. Whether to send notifications about the creation of the new event. Note that some emails might still be sent even if you set the value to false. The default is false.',
  ),
  'supportsAttachments' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether API client performing operation supports event attachments. Optional. The default is False.',
  ),
  'sendUpdates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Whether to send notifications about the creation of the new event. Note that some emails might still be sent. The default is false.',
    'enum' =>
    array (
      0 => 'all',
      1 => 'externalOnly',
      2 => 'none',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Event` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/calendars/{calendarId}/events';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxAttendees',
  1 => 'conferenceDataVersion',
  2 => 'sendNotifications',
  3 => 'supportsAttachments',
  4 => 'sendUpdates',
);
    protected const BODY_REQUIRED = true;
}
