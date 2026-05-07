<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a new job ad.
 *
 * Maps to jobs-api.json endpoint POST /jobs/{jobId}/jobads.
 */
class SmartRecruitersJobsJobsJobadsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_jobads_create";
    protected const DESCRIPTION = "Create a new job ad\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/jobads from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "job ad",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/jobads";
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
