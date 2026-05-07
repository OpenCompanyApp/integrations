<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update position.
 *
 * Maps to jobs-api.json endpoint PUT /jobs/{jobId}/positions/{positionId}.
 */
class SmartRecruitersJobsJobsPositionsUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_positions_update";
    protected const DESCRIPTION = "Update position\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId}/positions/{positionId} from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "position_id" => [
            "type" => "string",
            "required" => true,
            "description" => "position identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Position body object",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/positions/{positionId}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
        "positionId" => "position_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
