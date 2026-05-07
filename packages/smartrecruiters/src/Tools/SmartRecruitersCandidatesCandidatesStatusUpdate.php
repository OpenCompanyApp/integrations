<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update a candidate's status.
 *
 * Maps to candidates-api.json endpoint PUT /candidates/{id}/jobs/{jobId}/status.
 */
class SmartRecruitersCandidatesCandidatesStatusUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_status_update";
    protected const DESCRIPTION = "Update a candidate's status\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/status from candidates-api.json.";
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
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Candidate Status to be set",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/jobs/{jobId}/status";
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
