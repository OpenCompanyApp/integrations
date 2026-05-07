<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add hiring team member of a job with a given id..
 *
 * Maps to jobs-api.json endpoint POST /jobs/{jobId}/hiring-team.
 */
class SmartRecruitersJobsJobsHiringTeamAdd extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_hiring_team_add";
    protected const DESCRIPTION = "Add hiring team member of a job with a given id.\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/hiring-team from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "HiringTeamMember object",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/hiring-team";
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
