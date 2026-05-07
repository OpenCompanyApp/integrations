<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get event's details.
 *
 * Maps to event-management-api.json endpoint GET /events/{eventId}.
 */
class SmartRecruitersEventManagementGetEventDetails extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_get_event_details";
    protected const DESCRIPTION = "Get event's details\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId} from event-management-api.json.";
    protected const PARAMETERS = [
        "event_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `eventId`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events/{eventId}";
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
