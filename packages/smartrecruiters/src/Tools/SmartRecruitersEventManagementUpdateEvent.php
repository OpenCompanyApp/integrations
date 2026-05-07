<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update event.
 *
 * Maps to event-management-api.json endpoint PUT /events/{eventId}.
 */
class SmartRecruitersEventManagementUpdateEvent extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_update_event";
    protected const DESCRIPTION = "Update event\n\nOfficial SmartRecruiters endpoint: PUT /events/{eventId} from event-management-api.json.";
    protected const PARAMETERS = [
        "event_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `eventId`.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Update event.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events/{eventId}";
    protected const PATH_PARAMS = [
        "eventId" => "event_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
