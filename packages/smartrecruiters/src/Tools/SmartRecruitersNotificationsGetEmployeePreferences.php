<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get list of employee notifications preferences for a specific channel..
 *
 * Maps to notifications-api.json endpoint GET /employee-preferences.
 */
class SmartRecruitersNotificationsGetEmployeePreferences extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_notifications_get_employee_preferences";
    protected const DESCRIPTION = "Get list of employee notifications preferences for a specific channel.\n\nOfficial SmartRecruiters endpoint: GET /employee-preferences from notifications-api.json.";
    protected const PARAMETERS = [
        "channel" => [
            "type" => "string",
            "enum" => [
                "SLACK",
                "TEAMS",
                "EMAIL",
            ],
            "required" => true,
            "description" => "query parameter `channel`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/notification-preferences";
    protected const PATH = "/employee-preferences";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "channel" => "channel",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
