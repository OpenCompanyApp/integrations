<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves a review.
 *
 * Maps to reviews.json endpoint GET /reviews/{reviewId}.
 */
class SmartRecruitersReviewsReviewsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reviews_reviews_get";
    protected const DESCRIPTION = "Retrieves a review\n\nOfficial SmartRecruiters endpoint: GET /reviews/{reviewId} from reviews.json.";
    protected const PARAMETERS = [
        "review_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the review",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reviews-api/v201910";
    protected const PATH = "/reviews/{reviewId}";
    protected const PATH_PARAMS = [
        "reviewId" => "review_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
