<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get details of a candidate.
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}.
 */
class SmartRecruitersCandidatesCandidatesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_get";
    protected const DESCRIPTION = "Get details of a candidate\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id} from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
