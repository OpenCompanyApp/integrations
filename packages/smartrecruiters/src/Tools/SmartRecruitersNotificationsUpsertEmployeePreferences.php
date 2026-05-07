<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Activate or deactivate employee notification preferences for hiring roles and notification channels in bulk..
 *
 * Maps to notifications-api.json endpoint PATCH /employee-preferences.
 */
class SmartRecruitersNotificationsUpsertEmployeePreferences extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_notifications_upsert_employee_preferences";
    protected const DESCRIPTION = "Activate or deactivate employee notification preferences for hiring roles and notification channels in bulk.\n\nOfficial SmartRecruiters endpoint: PATCH /employee-preferences from notifications-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters notifications-api.json schema for Activate or deactivate employee notification preferences for hiring roles and notification channels in bulk..",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/notification-preferences";
    protected const PATH = "/employee-preferences";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
