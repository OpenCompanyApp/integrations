<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendar List Delete.
 *
 * Maps to the official Calendar endpoint DELETE /users/me/calendarList/{calendarId}.
 */
class GoogleCalendarCalendarListDelete extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendar_list_delete';
    protected const DESCRIPTION = 'Calendar List Delete

Official Calendar endpoint: DELETE /users/me/calendarList/{calendarId}
Removes a calendar from the user\'s calendar list.';
    protected const PARAMETERS = array (
  'calendarId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarId` from the official Calendar API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/users/me/calendarList/{calendarId}';
    protected const PATH_PARAMS = array (
  0 => 'calendarId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
