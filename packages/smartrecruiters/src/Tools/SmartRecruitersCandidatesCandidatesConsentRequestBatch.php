<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Request consent from multiple candidates.
 *
 * Maps to candidates-api.json endpoint POST /candidates/consent-requests.
 */
class SmartRecruitersCandidatesCandidatesConsentRequestBatch extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_consent_request_batch";
    protected const DESCRIPTION = "Request consent from multiple candidates\n\nOfficial SmartRecruiters endpoint: POST /candidates/consent-requests from candidates-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Request consent from multiple candidates.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/consent-requests";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
