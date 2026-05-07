<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendar List Update.
 *
 * Maps to the official Calendar endpoint PUT /users/me/calendarList/{calendarId}.
 */
class GoogleCalendarCalendarListUpdate extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendar_list_update';
    protected const DESCRIPTION = 'Calendar List Update

Official Calendar endpoint: PUT /users/me/calendarList/{calendarId}
Updates an existing calendar on the user\'s calendar list.';
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
    'description' => 'Query string parameters accepted by the official Calendar method. Known keys: colorRgbFormat.',
  ),
  'colorRgbFormat' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to use the foregroundColor and backgroundColor fields to write the calendar colors (RGB). If this feature is used, the index-based colorId field will be set to the best matching option automatically. Optional. The default is False.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `CalendarListEntry` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/users/me/calendarList/{calendarId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'colorRgbFormat',
);
    protected const BODY_REQUIRED = true;
}
