<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Attach file to candidate in context of given job..
 *
 * Maps to candidates-api.json endpoint POST /candidates/{id}/jobs/{jobId}/attachments.
 */
class SmartRecruitersCandidatesCandidatesAttachmentsAddForJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_attachments_add_for_job";
    protected const DESCRIPTION = "Attach file to candidate in context of given job.\n\nOfficial SmartRecruiters endpoint: POST /candidates/{id}/jobs/{jobId}/attachments from candidates-api.json.";
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
            "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Attach file to candidate in context of given job..",
        ],
    ];
    protected const METHOD = "POST";
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
    protected const BODY_MODE = "multipart";
    protected const AUTH_MODE = "either";
}
