<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Creates a review.
 *
 * Maps to reviews.json endpoint POST /reviews.
 */
class SmartRecruitersReviewsReviewsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reviews_reviews_create";
    protected const DESCRIPTION = "Creates a review\n\nOfficial SmartRecruiters endpoint: POST /reviews from reviews.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Review to be created",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/reviews-api/v201910";
    protected const PATH = "/reviews";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
