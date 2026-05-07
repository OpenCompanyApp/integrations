<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Search offers.
 *
 * Maps to offers-api.json endpoint GET /offers.
 */
class SmartRecruitersOffersCandidatesOffersFind extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_offers_candidates_offers_find";
    protected const DESCRIPTION = "Search offers\n\nOfficial SmartRecruiters endpoint: GET /offers from offers-api.json.";
    protected const PARAMETERS = [
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of elements to return. max value is 100",
        ],
        "offset" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of elements to skip while processing result",
        ],
        "created_after" => [
            "type" => "string",
            "required" => false,
            "description" => "ISO8601-formatted time boundaries for the offer creation time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
        ],
        "created_before" => [
            "type" => "string",
            "required" => false,
            "description" => "ISO8601-formatted time boundaries for the offer creation time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
        ],
        "age" => [
            "type" => "string",
            "required" => false,
            "description" => "word-based offer age; when age is specified createdAfter and createdBefore are ignored, Examples: 10 days, 7 hours, 1 week, etc.",
        ],
        "status" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "CREATED",
                    "PENDING_APPROVAL",
                    "APPROVED",
                    "NOT_APPROVED",
                    "PENDING_ACCEPTANCE",
                    "ACCEPTED",
                    "NOT_ACCEPTED",
                    "ABANDONED",
                ],
            ],
            "required" => false,
            "description" => "offer states that need to be included in the results; by default all states are included",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/offers";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "limit" => "limit",
        "offset" => "offset",
        "createdAfter" => "created_after",
        "createdBefore" => "created_before",
        "age" => "age",
        "status" => "status",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
