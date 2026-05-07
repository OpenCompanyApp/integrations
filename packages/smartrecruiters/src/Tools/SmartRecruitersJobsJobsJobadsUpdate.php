<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update a job ad.
 *
 * Maps to jobs-api.json endpoint PUT /jobs/{jobId}/jobads/{jobAdId}.
 */
class SmartRecruitersJobsJobsJobadsUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_jobads_update";
    protected const DESCRIPTION = "Update a job ad\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId}/jobads/{jobAdId} from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "job_ad_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job ad identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "job ad",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/jobads/{jobAdId}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
        "jobAdId" => "job_ad_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
