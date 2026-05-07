<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update a self schedule interview.
 *
 * Maps to self-scheduling.json endpoint PUT /self-schedules/{id}/application/{applicationUuid}/interview.
 */
class SmartRecruitersSelfSchedulingUpdateSelfScheduleInterview extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_self_scheduling_update_self_schedule_interview";
    protected const DESCRIPTION = "Update a self schedule interview\n\nOfficial SmartRecruiters endpoint: PUT /self-schedules/{id}/application/{applicationUuid}/interview from self-scheduling.json.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Update a self schedule interview.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/self-scheduling";
    protected const PATH = "/self-schedules/{id}/application/{applicationUuid}/interview";
    protected const PATH_PARAMS = [
        "id" => "id",
        "applicationUuid" => "application_uuid",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
