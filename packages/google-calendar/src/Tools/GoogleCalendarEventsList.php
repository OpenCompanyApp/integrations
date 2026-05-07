<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Events List.
 *
 * Maps to the official Calendar endpoint GET /calendars/{calendarId}/events.
 */
class GoogleCalendarEventsList extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_events_list';
    protected const DESCRIPTION = 'Events List

Official Calendar endpoint: GET /calendars/{calendarId}/events
Returns events on the specified calendar.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: eventTypes, updatedMin, sharedExtendedProperty, alwaysIncludeEmail, timeMax, privateExtendedProperty, syncToken, maxAttendees, showDeleted, timeMin, orderBy, q, timeZone, pageToken, iCalUID, showHiddenInvitations, singleEvents, maxResults.',
  ),
  'eventTypes' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Event types to return. Optional. This parameter can be repeated multiple times to return events of different types. If unset, returns all event types.',
    'enum' =>
    array (
      0 => 'birthday',
      1 => 'default',
      2 => 'focusTime',
      3 => 'fromGmail',
      4 => 'outOfOffice',
      5 => 'workingLocation',
    ),
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'updatedMin' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lower bound for an event\'s last modification time (as a RFC3339 timestamp) to filter by. When specified, entries deleted since this time will always be included regardless of showDeleted. Optional. The default is not to filter by last modification time.',
  ),
  'sharedExtendedProperty' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Extended properties constraint specified as propertyName=value. Matches only shared properties. This parameter might be repeated multiple times to return events that match all given constraints.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'alwaysIncludeEmail' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Deprecated and ignored.',
  ),
  'timeMax' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Upper bound (exclusive) for an event\'s start time to filter by. Optional. The default is not to filter by start time. Must be an RFC3339 timestamp with mandatory time zone offset, for example, 2011-06-03T10:00:00-07:00, 2011-06-03T10:00:00Z. Milliseconds may be provided but are ignored. If timeMin is set, timeMax must be greater than timeMin.',
  ),
  'privateExtendedProperty' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Extended properties constraint specified as propertyName=value. Matches only private properties. This parameter might be repeated multiple times to return events that match all given constraints.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token obtained from the nextSyncToken field returned on the last page of results from the previous list request. It makes the result of this list request contain only entries that have changed since then. All events deleted since the previous list request will always be in the result set and it is not allowed to set showDeleted to False. There are several query parameters that cannot be specified together with nextSyncToken to ensure consistency of the client state. These are: - iCalUID - orderBy - privateExtendedProperty - q - sharedExtendedProperty - timeMin - timeMax - updatedMin All other query parameters should be the same as for the initial synchronization to avoid undefined behavior. If the syncToken expires, the server will respond with a 410 GONE response code and the client should clear its storage and perform a full synchronization without any syncToken. Learn more about incremental synchronization. Optional. The default is to return all entries.',
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
    'description' => 'Whether to include deleted events (with status equals "cancelled") in the result. Cancelled instances of recurring events (but not the underlying recurring event) will still be included if showDeleted and singleEvents are both False. If showDeleted and singleEvents are both True, only single instances of deleted events (but not the underlying recurring events) are returned. Optional. The default is False.',
  ),
  'timeMin' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lower bound (exclusive) for an event\'s end time to filter by. Optional. The default is not to filter by end time. Must be an RFC3339 timestamp with mandatory time zone offset, for example, 2011-06-03T10:00:00-07:00, 2011-06-03T10:00:00Z. Milliseconds may be provided but are ignored. If timeMax is set, timeMin must be smaller than timeMax.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The order of the events returned in the result. Optional. The default is an unspecified, stable order.',
    'enum' =>
    array (
      0 => 'startTime',
      1 => 'updated',
    ),
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Free text search terms to find events that match these terms in the following fields: - summary - description - location - attendee\'s displayName - attendee\'s email - organizer\'s displayName - organizer\'s email - workingLocationProperties.officeLocation.buildingId - workingLocationProperties.officeLocation.deskId - workingLocationProperties.officeLocation.label - workingLocationProperties.customLocation.label These search terms also match predefined keywords against all display title translations of working location, out-of-office, and focus-time events. For example, searching for "Office" or "Bureau" returns working location events of type officeLocation, whereas searching for "Out of office" or "Abwesend" returns out-of-office events. Optional.',
  ),
  'timeZone' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Time zone used in the response. Optional. The default is the time zone of the calendar.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token specifying which result page to return. Optional.',
  ),
  'iCalUID' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Specifies an event ID in the iCalendar format to be provided in the response. Optional. Use this if you want to search for an event by its iCalendar ID.',
  ),
  'showHiddenInvitations' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to include hidden invitations in the result. Optional. The default is False.',
  ),
  'singleEvents' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to expand recurring events into instances and only return single one-off events and instances of recurring events, but not the underlying recurring events themselves. Optional. The default is False.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of events returned on one result page. The number of events in the resulting page may be less than this value, or none at all, even if there are more events matching the query. Incomplete pages can be detected by a non-empty nextPageToken field in the response. By default the value is 250 events. The page size can never be larger than 2500 events. Optional.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/calendars/{calendarId}/events';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'eventTypes',
  1 => 'updatedMin',
  2 => 'sharedExtendedProperty',
  3 => 'alwaysIncludeEmail',
  4 => 'timeMax',
  5 => 'privateExtendedProperty',
  6 => 'syncToken',
  7 => 'maxAttendees',
  8 => 'showDeleted',
  9 => 'timeMin',
  10 => 'orderBy',
  11 => 'q',
  12 => 'timeZone',
  13 => 'pageToken',
  14 => 'iCalUID',
  15 => 'showHiddenInvitations',
  16 => 'singleEvents',
  17 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
}
