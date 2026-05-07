<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Updates a review.
 *
 * Maps to reviews.json endpoint PATCH /reviews/{reviewId}.
 */
class SmartRecruitersReviewsReviewsUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reviews_reviews_update";
    protected const DESCRIPTION = "Updates a review\n\nOfficial SmartRecruiters endpoint: PATCH /reviews/{reviewId} from reviews.json.";
    protected const PARAMETERS = [
        "review_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the review",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Review to be updated",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/reviews-api/v201910";
    protected const PATH = "/reviews/{reviewId}";
    protected const PATH_PARAMS = [
        "reviewId" => "review_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
