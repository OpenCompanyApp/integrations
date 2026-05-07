<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update a job.
 *
 * Maps to jobs-api.json endpoint PATCH /jobs/{jobId}.
 */
class SmartRecruitersJobsJobsPatch extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_patch";
    protected const DESCRIPTION = "Update a job\n\nOfficial SmartRecruiters endpoint: PATCH /jobs/{jobId} from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters jobs-api.json schema for Update a job.",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
