<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Find schedule preferences.
 *
 * Maps to interview-templates.json endpoint GET /schedule/preferences/users/{userId}.
 */
class SmartRecruitersInterviewTemplatesGetSchedulePreferences extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_get_schedule_preferences";
    protected const DESCRIPTION = "Find schedule preferences\n\nOfficial SmartRecruiters endpoint: GET /schedule/preferences/users/{userId} from interview-templates.json.";
    protected const PARAMETERS = [
        "user_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of the user for which schedule preferences should be found",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/schedule/preferences/users/{userId}";
    protected const PATH_PARAMS = [
        "userId" => "user_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
