<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get application events.
 *
 * Maps to event-management-api.json endpoint GET /events/applications/{applicationId}.
 */
class SmartRecruitersEventManagementGetEventsForApplication extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_get_events_for_application";
    protected const DESCRIPTION = "Get application events\n\nOfficial SmartRecruiters endpoint: GET /events/applications/{applicationId} from event-management-api.json.";
    protected const PARAMETERS = [
        "application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Application ID",
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
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/event-management-api";
    protected const PATH = "/events/applications/{applicationId}";
    protected const PATH_PARAMS = [
        "applicationId" => "application_id",
    ];
    protected const QUERY_PARAMS = [
        "state" => "state",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
