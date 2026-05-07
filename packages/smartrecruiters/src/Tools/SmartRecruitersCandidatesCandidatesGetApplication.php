<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get details of a candidate's application to a job.
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}/jobs/{jobId}.
 */
class SmartRecruitersCandidatesCandidatesGetApplication extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_get_application";
    protected const DESCRIPTION = "Get details of a candidate's application to a job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId} from candidates-api.json.";
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
    protected const PATH = "/candidates/{id}/jobs/{jobId}";
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
