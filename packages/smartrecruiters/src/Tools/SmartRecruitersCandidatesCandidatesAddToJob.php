<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a new candidate and assign to a job.
 *
 * Maps to candidates-api.json endpoint POST /jobs/{jobId}/candidates.
 */
class SmartRecruitersCandidatesCandidatesAddToJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_add_to_job";
    protected const DESCRIPTION = "Create a new candidate and assign to a job\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/candidates from candidates-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Candidate object that needs to be created.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/candidates";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
