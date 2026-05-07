<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Patch.
 *
 * Maps to the official Calendar endpoint PATCH /calendars/{calendarId}/events/{eventId}.
 */
class GoogleCalendarEventsPatch extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_patch';
    protected const DESCRIPTION = 'Events Patch

Official Calendar endpoint: PATCH /calendars/{calendarId}/events/{eventId}
Updates an event. This method supports patch semantics.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: conferenceDataVersion, sendNotifications, supportsAttachments, alwaysIncludeEmail, sendUpdates, maxAttendees.',
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
    'description' => 'Deprecated. Please use sendUpdates instead. Whether to send notifications about the event update (for example, description changes, etc.). Note that some emails might still be sent even if you set the value to false. The default is false.',
  ),
  'supportsAttachments' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether API client performing operation supports event attachments. Optional. The default is False.',
  ),
  'alwaysIncludeEmail' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated and ignored. A value will always be returned in the email field for the organizer, creator and attendees, even if no real email address is available (i.e. a generated, non-working value will be provided).',
  ),
  'sendUpdates' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Guests who should receive notifications about the event update (for example, title changes, etc.).',
    'enum' =>
    array (
      0 => 'all',
      1 => 'externalOnly',
      2 => 'none',
    ),
  ),
  'maxAttendees' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of attendees to include in the response. If there are more than the specified number of attendees, only the participant is returned. Optional.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Event` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/calendars/{calendarId}/events/{eventId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
  1 => 'eventId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'conferenceDataVersion',
  1 => 'sendNotifications',
  2 => 'supportsAttachments',
  3 => 'alwaysIncludeEmail',
  4 => 'sendUpdates',
  5 => 'maxAttendees',
);
    protected const BODY_REQUIRED = true;
}
