<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

/**
 * Settings Get.
 *
 * Maps to the official Calendar endpoint GET /users/me/settings/{setting}.
 */
class GoogleCalendarSettingsGet extends AbstractGoogleCalendarTool
{
    protected const NAME = 'google_calendar_settings_get';
    protected const DESCRIPTION = 'Settings Get

Official Calendar endpoint: GET /users/me/settings/{setting}
Returns a single user setting.';
    protected const PARAMETERS = array (
  'setting' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `setting` from the official Calendar API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/users/me/settings/{setting}';
    protected const PATH_PARAMS = array (
  0 => 'setting',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
