<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get Onboarding Status for a candidate associated with given job.
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}/jobs/{jobId}/onboardingStatus.
 */
class SmartRecruitersCandidatesCandidatesOnboardingGetForJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_onboarding_get_for_job";
    protected const DESCRIPTION = "Get Onboarding Status for a candidate associated with given job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/onboardingStatus from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/jobs/{jobId}/onboardingStatus";
    protected const PATH_PARAMS = [
        "id" => "id",
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
