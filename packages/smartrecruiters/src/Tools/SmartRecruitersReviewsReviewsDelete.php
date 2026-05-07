<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Deletes a review.
 *
 * Maps to reviews.json endpoint DELETE /reviews/{reviewId}.
 */
class SmartRecruitersReviewsReviewsDelete extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reviews_reviews_delete";
    protected const DESCRIPTION = "Deletes a review\n\nOfficial SmartRecruiters endpoint: DELETE /reviews/{reviewId} from reviews.json.";
    protected const PARAMETERS = [
        "review_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the review",
        ],
        "reviewer_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the reviewer",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com/reviews-api/v201910";
    protected const PATH = "/reviews/{reviewId}";
    protected const PATH_PARAMS = [
        "reviewId" => "review_id",
    ];
    protected const QUERY_PARAMS = [
        "reviewerId" => "reviewer_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
