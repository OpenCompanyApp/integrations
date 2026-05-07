<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get available job property values.
 *
 * Maps to configuration-api.json endpoint GET /configuration/job-properties/{id}/values.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesValuesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_values_get";
    protected const DESCRIPTION = "Get available job property values\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties/{id}/values from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "accept_language" => [
            "type" => "string",
            "enum" => [
                "af",
                "am",
                "ar",
                "az",
                "bg",
                "bn",
                "ca",
                "cs",
                "cy",
                "da",
                "de",
                "el",
                "en",
                "en-GB",
                "es",
                "es-MX",
                "et",
                "eu",
                "fa",
                "fi",
                "fil",
                "fr",
                "fr-CA",
                "ga",
                "gl",
                "gu",
                "he",
                "hi",
                "hr",
                "hu",
                "hy",
                "id",
                "is",
                "it",
                "ja",
                "ka",
                "km",
                "kn",
                "ko",
                "lo",
                "lt",
                "lv",
                "ml",
                "mn",
                "mr",
                "ms",
                "ne",
                "nl",
                "no",
                "pl",
                "pt",
                "pt-BR",
                "ro",
                "ru",
                "si",
                "sk",
                "sl",
                "sr",
                "sv",
                "sw",
                "ta",
                "te",
                "th",
                "tr",
                "uk",
                "ur",
                "vi",
                "zh-CN",
                "zh-TW",
                "zu",
            ],
            "required" => false,
            "description" => "language of returned content",
        ],
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "pageId",
        ],
        "page_size" => [
            "type" => "integer",
            "required" => false,
            "description" => "pageSize",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/values";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [
        "pageId" => "page_id",
        "pageSize" => "page_size",
    ];
    protected const HEADER_PARAMS = [
        "Accept-Language" => "accept_language",
    ];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
