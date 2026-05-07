<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get list of all employee notifications preferences..
 *
 * Maps to notifications-api.json endpoint GET /employee-preferences/all.
 */
class SmartRecruitersNotificationsGetAllEmployeePreferences extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_notifications_get_all_employee_preferences";
    protected const DESCRIPTION = "Get list of all employee notifications preferences.\n\nOfficial SmartRecruiters endpoint: GET /employee-preferences/all from notifications-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/notification-preferences";
    protected const PATH = "/employee-preferences/all";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
