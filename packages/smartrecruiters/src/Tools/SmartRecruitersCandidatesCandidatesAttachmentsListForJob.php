<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get list of candidate's attachments in context of given job..
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}/jobs/{jobId}/attachments.
 */
class SmartRecruitersCandidatesCandidatesAttachmentsListForJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_attachments_list_for_job";
    protected const DESCRIPTION = "Get list of candidate's attachments in context of given job.\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/attachments from candidates-api.json.";
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
    protected const PATH = "/candidates/{id}/jobs/{jobId}/attachments";
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
