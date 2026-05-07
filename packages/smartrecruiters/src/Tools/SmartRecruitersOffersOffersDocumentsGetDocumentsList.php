<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get a list of documents related to sent offer..
 *
 * Maps to offers-api.json endpoint GET /offers/{offerId}/documents.
 */
class SmartRecruitersOffersOffersDocumentsGetDocumentsList extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_offers_offers_documents_get_documents_list";
    protected const DESCRIPTION = "Get a list of documents related to sent offer.\n\nOfficial SmartRecruiters endpoint: GET /offers/{offerId}/documents from offers-api.json.";
    protected const PARAMETERS = [
        "offer_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of an offer.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/offers/{offerId}/documents";
    protected const PATH_PARAMS = [
        "offerId" => "offer_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
