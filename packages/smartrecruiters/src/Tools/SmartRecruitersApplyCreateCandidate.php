<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a New Candidate Application.
 *
 * Maps to apply-api.json endpoint POST /postings/{uuid}/candidates.
 */
class SmartRecruitersApplyCreateCandidate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_apply_create_candidate";
    protected const DESCRIPTION = "Create a New Candidate Application\n\nOfficial SmartRecruiters endpoint: POST /postings/{uuid}/candidates from apply-api.json.";
    protected const PARAMETERS = [
        "uuid" => [
            "type" => "string",
            "required" => true,
            "description" => "Posting UUID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters apply-api.json schema for Create a New Candidate Application.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/postings/{uuid}/candidates";
    protected const PATH_PARAMS = [
        "uuid" => "uuid",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
