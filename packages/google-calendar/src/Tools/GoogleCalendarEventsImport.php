<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events Import.
 *
 * Maps to the official Calendar endpoint POST /calendars/{calendarId}/events/import.
 */
class GoogleCalendarEventsImport extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_import';
    protected const DESCRIPTION = 'Events Import

Official Calendar endpoint: POST /calendars/{calendarId}/events/import
Imports an event. This operation is used to add a private copy of an existing event to a calendar. Only events with an eventType of default may be imported. Deprecated behavior: If a non-default event is imported, its type will be changed to default and any event-type-specific properties it may have will be dropped.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: conferenceDataVersion, supportsAttachments.',
  ),
  'conferenceDataVersion' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Version number of conference data supported by the API client. Version 0 assumes no conference data support and ignores conference data in the event\'s body. Version 1 enables support for copying of ConferenceData as well as for creating new conferences using the createRequest field of conferenceData. The default is 0.',
  ),
  'supportsAttachments' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether API client performing operation supports event attachments. Optional. The default is False.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Event` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/calendars/{calendarId}/events/import';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'conferenceDataVersion',
  1 => 'supportsAttachments',
);
    protected const BODY_REQUIRED = true;
}
