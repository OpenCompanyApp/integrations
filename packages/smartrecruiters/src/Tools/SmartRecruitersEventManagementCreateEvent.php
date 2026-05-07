<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create event.
 *
 * Maps to event-management-api.json endpoint POST /events.
 */
class SmartRecruitersEventManagementCreateEvent extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_create_event";
    protected const DESCRIPTION = "Create event\n\nOfficial SmartRecruiters endpoint: POST /events from event-management-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Create event.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
