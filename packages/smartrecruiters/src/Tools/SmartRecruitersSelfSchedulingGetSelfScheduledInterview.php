<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns self-scheduled interview.
 *
 * Maps to self-scheduling.json endpoint GET /self-schedules/{id}/application/{applicationUuid}/interview.
 */
class SmartRecruitersSelfSchedulingGetSelfScheduledInterview extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_self_scheduling_get_self_scheduled_interview";
    protected const DESCRIPTION = "Returns self-scheduled interview\n\nOfficial SmartRecruiters endpoint: GET /self-schedules/{id}/application/{applicationUuid}/interview from self-scheduling.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
        "application_uuid" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `applicationUuid`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/self-scheduling";
    protected const PATH = "/self-schedules/{id}/application/{applicationUuid}/interview";
    protected const PATH_PARAMS = [
        "id" => "id",
        "applicationUuid" => "application_uuid",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
