<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Candidate consent decisions.
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}/consents.
 */
class SmartRecruitersCandidatesCandidatesConsentDecisions extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_consent_decisions";
    protected const DESCRIPTION = "Candidate consent decisions\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/consents from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/consents";
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
