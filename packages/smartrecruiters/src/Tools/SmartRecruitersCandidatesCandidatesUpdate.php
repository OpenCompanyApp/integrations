<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update candidate personal information.
 *
 * Maps to candidates-api.json endpoint PATCH /candidates/{id}.
 */
class SmartRecruitersCandidatesCandidatesUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_update";
    protected const DESCRIPTION = "Update candidate personal information\n\nOfficial SmartRecruiters endpoint: PATCH /candidates/{id} from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Candidate personal information",
        ],
    ];
    protected const METHOD = "PATCH";
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
