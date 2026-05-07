<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves all criteria for specified job.
 *
 * Maps to reviews.json endpoint GET /jobs/{jobId}/criteria.
 */
class SmartRecruitersReviewsScorecardsCriteriaGetByJobId extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reviews_scorecards_criteria_get_by_job_id";
    protected const DESCRIPTION = "Retrieves all criteria for specified job\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/criteria from reviews.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the job",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reviews-api/v201910";
    protected const PATH = "/jobs/{jobId}/criteria";
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
