<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Unpublish a job ad.
 *
 * Maps to jobs-api.json endpoint DELETE /jobs/{jobId}/jobads/{jobAdId}/postings.
 */
class SmartRecruitersJobsJobsJobadsPostingsUnpublish extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_jobads_postings_unpublish";
    protected const DESCRIPTION = "Unpublish a job ad\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/jobads/{jobAdId}/postings from jobs-api.json.";
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
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/jobads/{jobAdId}/postings";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
        "jobAdId" => "job_ad_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
