<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get job property's dependent values.
 *
 * Maps to configuration-api.json endpoint GET /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_dependents_values_get";
    protected const DESCRIPTION = "Get job property's dependent values\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "value_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property's value identifier",
        ],
        "dependent_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property's dependent identifier",
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
    protected const PATH = "/configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values";
    protected const PATH_PARAMS = [
        "id" => "id",
        "valueId" => "value_id",
        "dependentId" => "dependent_id",
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
