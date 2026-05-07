<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves all reviews for specified candidate and job.
 *
 * Maps to reviews.json endpoint GET /reviews.
 */
class SmartRecruitersReviewsReviewsGetList extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reviews_reviews_get_list";
    protected const DESCRIPTION = "Retrieves all reviews for specified candidate and job\n\nOfficial SmartRecruiters endpoint: GET /reviews from reviews.json.";
    protected const PARAMETERS = [
        "candidate_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the candidate",
        ],
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the job",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reviews-api/v201910";
    protected const PATH = "/reviews";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "candidateId" => "candidate_id",
        "jobId" => "job_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
