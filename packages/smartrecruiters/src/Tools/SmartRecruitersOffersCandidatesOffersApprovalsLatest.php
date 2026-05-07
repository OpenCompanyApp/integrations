<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get latest approval request for candidate's offer.
 *
 * Maps to offers-api.json endpoint GET /candidates/{id}/jobs/{jobId}/offers/{offerId}/approvals/latest.
 */
class SmartRecruitersOffersCandidatesOffersApprovalsLatest extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_offers_candidates_offers_approvals_latest";
    protected const DESCRIPTION = "Get latest approval request for candidate's offer\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/offers/{offerId}/approvals/latest from offers-api.json.";
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
        "offer_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of a Offer",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/jobs/{jobId}/offers/{offerId}/approvals/latest";
    protected const PATH_PARAMS = [
        "id" => "id",
        "jobId" => "job_id",
        "offerId" => "offer_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
