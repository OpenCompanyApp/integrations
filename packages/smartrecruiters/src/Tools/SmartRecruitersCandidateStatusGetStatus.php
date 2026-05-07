<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get candidate status.
 *
 * Maps to candidate-status-api.json endpoint GET /status/{applicationUuid}.
 */
class SmartRecruitersCandidateStatusGetStatus extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidate_status_get_status";
    protected const DESCRIPTION = "Get candidate status\n\nOfficial SmartRecruiters endpoint: GET /status/{applicationUuid} from candidate-status-api.json.";
    protected const PARAMETERS = [
        "application_uuid" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `applicationUuid`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/candidate-status-api";
    protected const PATH = "/status/{applicationUuid}";
    protected const PATH_PARAMS = [
        "applicationUuid" => "application_uuid",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
