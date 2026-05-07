<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Updates job status.
 *
 * Maps to jobs-api.json endpoint PUT /jobs/{jobId}/status.
 */
class SmartRecruitersJobsJobsStatusUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_status_update";
    protected const DESCRIPTION = "Updates job status\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId}/status from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters jobs-api.json schema for Updates job status.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/status";
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
