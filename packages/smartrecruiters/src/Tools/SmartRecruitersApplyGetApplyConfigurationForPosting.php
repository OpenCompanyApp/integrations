<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get application configuration for posting.
 *
 * Maps to apply-api.json endpoint GET /postings/{uuid}/configuration.
 */
class SmartRecruitersApplyGetApplyConfigurationForPosting extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_apply_get_apply_configuration_for_posting";
    protected const DESCRIPTION = "Get application configuration for posting\n\nOfficial SmartRecruiters endpoint: GET /postings/{uuid}/configuration from apply-api.json.";
    protected const PARAMETERS = [
        "accept_language" => [
            "type" => "string",
            "required" => false,
            "description" => "Language for screening questions. By default 'en'.",
        ],
        "uuid" => [
            "type" => "string",
            "required" => true,
            "description" => "Posting UUID",
        ],
        "conditionals_included" => [
            "type" => "boolean",
            "required" => false,
            "description" => "Specifies whether conditional questions should be returned in the response. 'false' if not specified",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/postings/{uuid}/configuration";
    protected const PATH_PARAMS = [
        "uuid" => "uuid",
    ];
    protected const QUERY_PARAMS = [
        "conditionalsIncluded" => "conditionals_included",
    ];
    protected const HEADER_PARAMS = [
        "Accept-Language" => "accept_language",
    ];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
