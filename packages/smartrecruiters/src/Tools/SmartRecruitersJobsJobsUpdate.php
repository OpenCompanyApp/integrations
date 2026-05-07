<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Updates job.
 *
 * Maps to jobs-api.json endpoint PUT /jobs/{jobId}.
 */
class SmartRecruitersJobsJobsUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_update";
    protected const DESCRIPTION = "Updates job\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId} from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Job that needs to be updated",
        ],
    ];
    protected const METHOD = "PUT";
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
