<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update job headcount..
 *
 * Maps to jobs-api.json endpoint PATCH /jobs/{jobId}/headcount.
 */
class SmartRecruitersJobsJobsHeadcountUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_headcount_update";
    protected const DESCRIPTION = "Update job headcount.\n\nOfficial SmartRecruiters endpoint: PATCH /jobs/{jobId}/headcount from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters jobs-api.json schema for Update job headcount..",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/headcount";
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
