<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Search for a self-scheduling instances.
 *
 * Maps to self-scheduling.json endpoint GET /self-schedules.
 */
class SmartRecruitersSelfSchedulingSearchSelfSchedules extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_self_scheduling_search_self_schedules";
    protected const DESCRIPTION = "Search for a self-scheduling instances\n\nOfficial SmartRecruiters endpoint: GET /self-schedules from self-scheduling.json.";
    protected const PARAMETERS = [
        "with_interviews" => [
            "type" => "boolean",
            "required" => false,
            "description" => "If set - filters out self schedules with interviews created/not created",
        ],
        "application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "query parameter `applicationId`.",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "query parameter `limit`.",
        ],
        "offset" => [
            "type" => "integer",
            "required" => false,
            "description" => "query parameter `offset`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/self-scheduling";
    protected const PATH = "/self-schedules";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "withInterviews" => "with_interviews",
        "applicationId" => "application_id",
        "limit" => "limit",
        "offset" => "offset",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
