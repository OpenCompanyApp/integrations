<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get candidate status.
 *
 * Maps to apply-api.json endpoint GET /postings/{uuid}/candidates/{candidateId}/status.
 */
class SmartRecruitersApplyGetApplicationStatus extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_apply_get_application_status";
    protected const DESCRIPTION = "Get candidate status\n\nOfficial SmartRecruiters endpoint: GET /postings/{uuid}/candidates/{candidateId}/status from apply-api.json.";
    protected const PARAMETERS = [
        "uuid" => [
            "type" => "string",
            "required" => true,
            "description" => "Posting UUID",
        ],
        "candidate_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `candidateId`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/postings/{uuid}/candidates/{candidateId}/status";
    protected const PATH_PARAMS = [
        "uuid" => "uuid",
        "candidateId" => "candidate_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
