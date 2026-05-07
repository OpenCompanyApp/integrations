<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get event's session details.
 *
 * Maps to event-management-api.json endpoint GET /events/{eventId}/sessions/{sessionId}.
 */
class SmartRecruitersEventManagementGetSessionDetails extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_get_session_details";
    protected const DESCRIPTION = "Get event's session details\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId}/sessions/{sessionId} from event-management-api.json.";
    protected const PARAMETERS = [
        "event_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `eventId`.",
        ],
        "session_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `sessionId`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events/{eventId}/sessions/{sessionId}";
    protected const PATH_PARAMS = [
        "eventId" => "event_id",
        "sessionId" => "session_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
