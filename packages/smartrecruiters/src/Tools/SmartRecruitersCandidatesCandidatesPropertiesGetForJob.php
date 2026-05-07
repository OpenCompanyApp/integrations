<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get candidate property values for a candidate's job.
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}/jobs/{jobId}/properties.
 */
class SmartRecruitersCandidatesCandidatesPropertiesGetForJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_properties_get_for_job";
    protected const DESCRIPTION = "Get candidate property values for a candidate's job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/properties from candidates-api.json.";
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
        "context" => [
            "type" => "string",
            "enum" => [
                "PROFILE",
                "OFFER_FORM",
                "HIRE_FORM",
                "OFFER_APPROVAL_FORM",
            ],
            "required" => false,
            "description" => "context for candidate properties to display",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/jobs/{jobId}/properties";
    protected const PATH_PARAMS = [
        "id" => "id",
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [
        "context" => "context",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
