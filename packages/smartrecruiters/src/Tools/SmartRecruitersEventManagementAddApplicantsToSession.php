<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add applicants from event pool to session.
 *
 * Maps to event-management-api.json endpoint POST /events/{eventId}/sessions/{sessionId}/applicants.
 */
class SmartRecruitersEventManagementAddApplicantsToSession extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_add_applicants_to_session";
    protected const DESCRIPTION = "Add applicants from event pool to session\n\nOfficial SmartRecruiters endpoint: POST /events/{eventId}/sessions/{sessionId}/applicants from event-management-api.json.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Add applicants from event pool to session.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events/{eventId}/sessions/{sessionId}/applicants";
    protected const PATH_PARAMS = [
        "eventId" => "event_id",
        "sessionId" => "session_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
