<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Removes hiring team member of a job with a given id..
 *
 * Maps to jobs-api.json endpoint DELETE /jobs/{jobId}/hiring-team/{userId}.
 */
class SmartRecruitersJobsJobsHiringTeamRemove extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_hiring_team_remove";
    protected const DESCRIPTION = "Removes hiring team member of a job with a given id.\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/hiring-team/{userId} from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "user_id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/hiring-team/{userId}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
        "userId" => "user_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
