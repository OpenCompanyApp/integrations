<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a new candidate and assign to a Talent Pool.
 *
 * Maps to candidates-api.json endpoint POST /candidates.
 */
class SmartRecruitersCandidatesCandidatesAdd extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_add";
    protected const DESCRIPTION = "Create a new candidate and assign to a Talent Pool\n\nOfficial SmartRecruiters endpoint: POST /candidates from candidates-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Candidate object that needs to be created.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
