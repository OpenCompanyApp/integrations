<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Calendars Insert.
 *
 * Maps to the official Calendar endpoint POST /calendars.
 */
class GoogleCalendarCalendarsInsert extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_calendars_insert';
    protected const DESCRIPTION = 'Calendars Insert

Official Calendar endpoint: POST /calendars
Creates a secondary calendar. The authenticated user for the request is made the data owner of the new calendar. Note: We recommend to authenticate as the intended data owner of the calendar. You can use domain-wide delegation of authority to allow applications to act on behalf of a specific user. Don\'t use a service account for authentication. If you use a service account for authentication, the service account is the data owner, which can lead to unexpected behavior. For example, if a service account is the data owner, data ownership cannot be transferred.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `Calendar` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/calendars';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
