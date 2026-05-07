<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update employee notifications preferences..
 *
 * Maps to notifications-api.json endpoint PATCH /employee-preferences/preferences/{preferenceId}.
 */
class SmartRecruitersNotificationsUpdateEmployeePreferences extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_notifications_update_employee_preferences";
    protected const DESCRIPTION = "Update employee notifications preferences.\n\nOfficial SmartRecruiters endpoint: PATCH /employee-preferences/preferences/{preferenceId} from notifications-api.json.";
    protected const PARAMETERS = [
        "preference_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `preferenceId`.",
        ],
        "enabled" => [
            "type" => "boolean",
            "required" => false,
            "description" => "query parameter `enabled`.",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/notification-preferences";
    protected const PATH = "/employee-preferences/preferences/{preferenceId}";
    protected const PATH_PARAMS = [
        "preferenceId" => "preference_id",
    ];
    protected const QUERY_PARAMS = [
        "enabled" => "enabled",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
