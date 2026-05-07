<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List departments for given company.
 *
 * Maps to posting-api.json endpoint GET /v1/companies/{companyIdentifier}/departments.
 */
class SmartRecruitersPostingV1ListDepartments extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_posting_v1_list_departments";
    protected const DESCRIPTION = "List departments for given company\n\nOfficial SmartRecruiters endpoint: GET /v1/companies/{companyIdentifier}/departments from posting-api.json.";
    protected const PARAMETERS = [
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
                "tr",
                "uk",
                "ur",
                "vi",
                "zh-CN",
                "zh-TW",
                "zu",
            ],
            "required" => false,
            "description" => "Language of translation",
        ],
        "company_identifier" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of a company",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/v1/companies/{companyIdentifier}/departments";
    protected const PATH_PARAMS = [
        "companyIdentifier" => "company_identifier",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "accept-language" => "accept_language",
    ];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "public";
}
