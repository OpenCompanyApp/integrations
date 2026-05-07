<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a new job.
 *
 * Maps to jobs-api.json endpoint POST /jobs.
 */
class SmartRecruitersJobsJobsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_create";
    protected const DESCRIPTION = "Create a new job\n\nOfficial SmartRecruiters endpoint: POST /jobs from jobs-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Job object that needs to be created",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
