<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Parse a resume, create a candidate and assign to a job..
 *
 * Maps to candidates-api.json endpoint POST /jobs/{jobId}/candidates/cv.
 */
class SmartRecruitersCandidatesCandidatesResumeAddToJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_resume_add_to_job";
    protected const DESCRIPTION = "Parse a resume, create a candidate and assign to a job.\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/candidates/cv from candidates-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Parse a resume, create a candidate and assign to a job..",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/candidates/cv";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "multipart";
    protected const AUTH_MODE = "either";
}
