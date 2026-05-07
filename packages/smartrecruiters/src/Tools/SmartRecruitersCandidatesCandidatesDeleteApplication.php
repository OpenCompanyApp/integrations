<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Delete candidate's application to a job.
 *
 * Maps to candidates-api.json endpoint DELETE /candidates/{id}/jobs/{jobId}.
 */
class SmartRecruitersCandidatesCandidatesDeleteApplication extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_delete_application";
    protected const DESCRIPTION = "Delete candidate's application to a job\n\nOfficial SmartRecruiters endpoint: DELETE /candidates/{id}/jobs/{jobId} from candidates-api.json.";
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
    protected const METHOD = "DELETE";
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
