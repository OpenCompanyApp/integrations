<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Colors Get.
 *
 * Maps to the official Calendar endpoint GET /colors.
 */
class GoogleCalendarColorsGet extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_colors_get';
    protected const DESCRIPTION = 'Colors Get

Official Calendar endpoint: GET /colors
Returns the color definitions for calendars and events.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/colors';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
