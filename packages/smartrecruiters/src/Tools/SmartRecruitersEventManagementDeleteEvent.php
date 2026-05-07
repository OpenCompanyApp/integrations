<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Delete event.
 *
 * Maps to event-management-api.json endpoint DELETE /events/{eventId}.
 */
class SmartRecruitersEventManagementDeleteEvent extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_delete_event";
    protected const DESCRIPTION = "Delete event\n\nOfficial SmartRecruiters endpoint: DELETE /events/{eventId} from event-management-api.json.";
    protected const PARAMETERS = [
        "event_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `eventId`.",
        ],
    ];
    protected const METHOD = "DELETE";
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
