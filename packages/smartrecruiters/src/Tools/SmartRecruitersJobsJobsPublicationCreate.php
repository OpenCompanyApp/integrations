<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Publishes a default job ad.
 *
 * Maps to jobs-api.json endpoint POST /jobs/{jobId}/publication.
 */
class SmartRecruitersJobsJobsPublicationCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_publication_create";
    protected const DESCRIPTION = "Publishes a default job ad\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/publication from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Publication object",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/publication";
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
