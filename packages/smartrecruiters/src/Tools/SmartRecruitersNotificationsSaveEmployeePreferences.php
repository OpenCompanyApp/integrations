<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Save employee notifications preferences..
 *
 * Maps to notifications-api.json endpoint POST /employee-preferences.
 */
class SmartRecruitersNotificationsSaveEmployeePreferences extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_notifications_save_employee_preferences";
    protected const DESCRIPTION = "Save employee notifications preferences.\n\nOfficial SmartRecruiters endpoint: POST /employee-preferences from notifications-api.json.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters notifications-api.json schema for Save employee notifications preferences..",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/notification-preferences";
    protected const PATH = "/employee-preferences";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "channel" => "channel",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
