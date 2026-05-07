<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get candidate events.
 *
 * Maps to event-management-api.json endpoint GET /events/candidates/{profileId}.
 */
class SmartRecruitersEventManagementGetEventsForCandidate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_event_management_get_events_for_candidate";
    protected const DESCRIPTION = "Get candidate events\n\nOfficial SmartRecruiters endpoint: GET /events/candidates/{profileId} from event-management-api.json.";
    protected const PARAMETERS = [
        "profile_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Candidate profile ID",
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
    protected const PATH = "/events/candidates/{profileId}";
    protected const PATH_PARAMS = [
        "profileId" => "profile_id",
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
