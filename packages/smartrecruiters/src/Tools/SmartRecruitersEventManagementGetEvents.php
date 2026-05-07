<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get job's events.
 *
 * Maps to event-management-api.json endpoint GET /events.
 */
class SmartRecruitersEventManagementGetEvents extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_get_events";
    protected const DESCRIPTION = "Get job's events\n\nOfficial SmartRecruiters endpoint: GET /events from event-management-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Job ID",
        ],
        "state" => [
            "type" => "string",
            "enum" => [
                "PAST",
                "ACTIVE",
            ],
            "required" => true,
            "description" => "Event state",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "Page number beginning from 0",
        ],
        "page_size" => [
            "type" => "integer",
            "required" => false,
            "description" => "Page size default is 10",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "jobId" => "job_id",
        "state" => "state",
        "page" => "page",
        "pageSize" => "page_size",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
