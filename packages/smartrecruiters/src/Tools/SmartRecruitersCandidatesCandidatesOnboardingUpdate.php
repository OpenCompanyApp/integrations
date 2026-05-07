<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Set Onboarding Status for a candidate.
 *
 * Maps to candidates-api.json endpoint PUT /candidates/{id}/onboardingStatus.
 */
class SmartRecruitersCandidatesCandidatesOnboardingUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_onboarding_update";
    protected const DESCRIPTION = "Set Onboarding Status for a candidate\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/onboardingStatus from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Onboarding status.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/onboardingStatus";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
