<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get event's applicants.
 *
 * Maps to event-management-api.json endpoint GET /events/{eventId}/pool-applicants.
 */
class SmartRecruitersEventManagementGetApplicantsByEventId extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_get_applicants_by_event_id";
    protected const DESCRIPTION = "Get event's applicants\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId}/pool-applicants from event-management-api.json.";
    protected const PARAMETERS = [
        "event_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `eventId`.",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "query parameter `page`.",
        ],
        "page_size" => [
            "type" => "integer",
            "required" => false,
            "description" => "query parameter `pageSize`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events/{eventId}/pool-applicants";
    protected const PATH_PARAMS = [
        "eventId" => "event_id",
    ];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "pageSize" => "page_size",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
