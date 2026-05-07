<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Find global notification preferences..
 *
 * Maps to notifications-api.json endpoint GET /global-preferences.
 */
class SmartRecruitersNotificationsFindGlobalPreferences extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_notifications_find_global_preferences";
    protected const DESCRIPTION = "Find global notification preferences.\n\nOfficial SmartRecruiters endpoint: GET /global-preferences from notifications-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/notification-preferences";
    protected const PATH = "/global-preferences";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
