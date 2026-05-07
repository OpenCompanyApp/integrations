<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Unpublishes a job from all sources.
 *
 * Maps to jobs-api.json endpoint DELETE /jobs/{jobId}/publication.
 */
class SmartRecruitersJobsJobsPublicationUnpublish extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_publication_unpublish";
    protected const DESCRIPTION = "Unpublishes a job from all sources\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/publication from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
    ];
    protected const METHOD = "DELETE";
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
