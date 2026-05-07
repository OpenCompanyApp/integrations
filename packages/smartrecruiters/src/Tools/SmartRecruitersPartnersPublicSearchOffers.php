<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Search offers by criteria.
 *
 * Maps to partners-public-api.json endpoint GET /offers.
 */
class SmartRecruitersPartnersPublicSearchOffers extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_partners_public_search_offers";
    protected const DESCRIPTION = "Search offers by criteria\n\nOfficial SmartRecruiters endpoint: GET /offers from partners-public-api.json.";
    protected const PARAMETERS = [
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of offers to return. max number of offers returned by single call is 100",
        ],
        "offset" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of offers to skip while processing result",
        ],
        "status" => [
            "type" => "string",
            "required" => false,
            "description" => "offer status; available values are: INACTIVE, UNDER_REVIEW, ACTIVE, REJECTED",
        ],
        "q" => [
            "type" => "string",
            "required" => false,
            "description" => "full text query. will match offers with name and description matching query string",
        ],
        "posting_id" => [
            "type" => "string",
            "required" => false,
            "description" => "id of a job posting; allows getting offer information using Posting Id coming from Job Board API; not relevant for Assessment vendors",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/v1";
    protected const PATH = "/offers";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "limit" => "limit",
        "offset" => "offset",
        "status" => "status",
        "q" => "q",
        "postingId" => "posting_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
