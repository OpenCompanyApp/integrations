<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Freebusy Query.
 *
 * Maps to the official Calendar endpoint POST /freeBusy.
 */
class GoogleCalendarFreebusyQuery extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_freebusy_query';
    protected const DESCRIPTION = 'Freebusy Query

Official Calendar endpoint: POST /freeBusy
Returns free/busy information for a set of calendars.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Calendar API `FreeBusyRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/freeBusy';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
