<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Delete position.
 *
 * Maps to jobs-api.json endpoint DELETE /jobs/{jobId}/positions/{positionId}.
 */
class SmartRecruitersJobsJobsPositionsRemove extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_positions_remove";
    protected const DESCRIPTION = "Delete position\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/positions/{positionId} from jobs-api.json.";
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
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/positions/{positionId}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
        "positionId" => "position_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
