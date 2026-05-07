<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get candidate's offers.
 *
 * Maps to offers-api.json endpoint GET /candidates/{id}/jobs/{jobId}/offers.
 */
class SmartRecruitersOffersCandidatesOffersAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_offers_candidates_offers_all";
    protected const DESCRIPTION = "Get candidate's offers\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/offers from offers-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/jobs/{jobId}/offers";
    protected const PATH_PARAMS = [
        "id" => "id",
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
