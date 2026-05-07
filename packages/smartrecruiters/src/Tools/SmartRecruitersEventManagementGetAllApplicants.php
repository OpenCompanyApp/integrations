<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get all applicants (both event-applicants-pool and session-applicants) for specified event.
 *
 * Maps to event-management-api.json endpoint GET /events/{eventId}/applicants.
 */
class SmartRecruitersEventManagementGetAllApplicants extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_get_all_applicants";
    protected const DESCRIPTION = "Get all applicants (both event-applicants-pool and session-applicants) for specified event\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId}/applicants from event-management-api.json.";
    protected const PARAMETERS = [
        "event_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `eventId`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events/{eventId}/applicants";
    protected const PATH_PARAMS = [
        "eventId" => "event_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
