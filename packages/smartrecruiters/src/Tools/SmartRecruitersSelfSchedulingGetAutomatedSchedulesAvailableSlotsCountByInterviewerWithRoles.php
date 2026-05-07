<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns the automated schedule available slots count based on interviewers availability and specified date params..
 *
 * Maps to self-scheduling.json endpoint POST /automated-self-schedules/{scheduleType}/application/{applicationUuid}/slots/count/by-role.
 */
class SmartRecruitersSelfSchedulingGetAutomatedSchedulesAvailableSlotsCountByInterviewerWithRoles extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_self_scheduling_get_automated_schedules_available_slots_count_by_interviewer_with_roles";
    protected const DESCRIPTION = "Returns the automated schedule available slots count based on interviewers availability and specified date params.\n\nOfficial SmartRecruiters endpoint: POST /automated-self-schedules/{scheduleType}/application/{applicationUuid}/slots/count/by-role from self-scheduling.json.";
    protected const PARAMETERS = [
        "schedule_type" => [
            "type" => "string",
            "enum" => [
                "INDIVIDUAL",
                "GROUP",
            ],
            "required" => true,
            "description" => "path parameter `scheduleType`.",
        ],
        "application_uuid" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `applicationUuid`.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Returns the automated schedule available slots count based on interviewers availability and specified date params..",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/self-scheduling";
    protected const PATH = "/automated-self-schedules/{scheduleType}/application/{applicationUuid}/slots/count/by-role";
    protected const PATH_PARAMS = [
        "scheduleType" => "schedule_type",
        "applicationUuid" => "application_uuid",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
